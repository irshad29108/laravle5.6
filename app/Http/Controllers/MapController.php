<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AlertTypeMaster;
use App\Models\City;
use App\Models\Country;
use App\Models\DeviceData;
use App\Models\DeviceMaster;
use App\Models\MapMaster;
use App\Models\ObjectMaster;
use App\Models\Role;
use App\Models\TimezoneMaster;
use App\Models\UserMapSetting;
use App\Models\UserMaster;
use App\Models\UserRuleSetting;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use \GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Session;

class MapController extends Controller
{
    /**
    * Create a new controller instance for request authorization.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
    public function maps() {
        $vehicles  = DeviceMaster::select('id', 'imei', 'name')->whereHas('object', function($query) {
            if (Auth::user()->master->type->id == Role::SUPER_ADMIN) {
                $where = [];
            } else {
                $where = ['company_id' => Auth::user()->master->id];
            }
            return $query->where($where);
        })->get();

        $apiResponse = $this->getAPIResponse();
        $vehicleLocations = $apiResponse != null ? $apiResponse->whereIn('IMEI', $vehicles->pluck('imei')) : null;
        $vehicleMapLocationArray = collect();
        if ($vehicleLocations != null) {
            $viewVehicles = [];
            $viewVehicleType = [];
            foreach ($vehicles as $vehicle) {
                $lastLocation = $vehicleLocations->where('IMEI', $vehicle->imei)->last();
                if ($lastLocation) {
                    $vehicleMapLocationArray->push(collect($lastLocation));
                }
            }
            $latArray = implode(',', $vehicleMapLocationArray->pluck('Lattitude')->toArray());
            $lngArray = implode(',', $vehicleMapLocationArray->pluck('Longitude')->toArray());
            $speedArray = implode(',', $vehicleMapLocationArray->pluck('Speed')->toArray());
            $imeiArray = $vehicleMapLocationArray->pluck('IMEI');
            foreach($imeiArray as $imei) {
                $viewVehicles[] = $vehicles->where('imei', $imei)->first()->object()->first()->plate_number;
                $viewVehicleType[] = $vehicles->where('imei', $imei)->first()->object()->first()->object_type;
            }
            $vehicleArray = implode(',', $viewVehicles);
        } else {
            $latArray = 0;
            $lngArray = 0;
            $vehicleArray = 0;
            $speedArray = 0;
            Session::flash('error', 'No Vehicle is running today!');
        }
        // dd($apiResponse);
        return view('pages.maps.tracking')->with([
            'vehicles' => $vehicles,
            'latArray' => $latArray,
            'lngArray' => $lngArray,
            'vehicleArray' => $vehicleArray,
            'speedArray' => $speedArray,
            'locations' => $vehicleLocations
            ]);
        }

        public function getLocation(Request $request) {
            $vehicles = DeviceMaster::where('imei', $request->imei)->with('locations', 'object')->first();
            $requestParams = ['date' => date('Ymd')];
            $apiResponse = $this->getAPIResponse($requestParams)->where('IMEI', $request->imei);
            $location = array();
            foreach ($apiResponse as $response) {
                $packetDateTime = Carbon::parse($response->created_at)->addHour(5)->addMinutes(30)->format('Y-m-d');
                $currentDateTime = date('Y-m-d');
                // && $response->IgnitionStatus != 0
                if ($response->Lattitude != 0 && $response->PacketStatus == "L" ) {
                    @$location = array(
                        'lat' => $response->Lattitude,
                        'lng' => $response->Longitude,
                        'Ignition' => $response->IgnitionStatus,
                        'speed' => $response->Speed,
                        'reachedOn' => date('H:i A, d M Y', strtotime('+5 hour +30 minute', strtotime($response->created_at)))
                    );
                }
            }
            if (count($location) > 0) {
                $locations = $location;
            } else {
                $locations = ['lat' => 0, 'lng' => 0];
            }
            $locationResponse = array_merge_recursive($locations);
            return response()->json(['data' => $locationResponse]);
        }

        /**
        * Show the application dashboard.
        *
        * @return \Illuminate\Contracts\Support\Renderable
        */
        public function playbacks(Request $request, $imei = '') {
            if ($imei != "") {
                $requestParams = [
                    'date' => date('Ymd'),
                    "IMEI" => $imei
                ];
                $vehicle = DeviceMaster::where('imei', $imei)->with('locations', 'object')->first();
                $liveData = $this->getAPIResponse($requestParams);
                $lastData = $liveData != null ? $liveData->where('IMEI', $imei)->last() : '';
                if($lastData == NULL) {
                    Session::flash('error', 'No playback found!');
                    return redirect()->back()->withInput($request->input());
                }
                $lastLocation = $lastData != null ? $this->getAddress($lastData->Lattitude, $lastData->Longitude) : "No location found.";
                $avgSpeed = number_format($liveData->filter(function ($query) {
                    return $query->Longitude > 0 && $query->Speed > 5;
                })->avg('Speed'), 2);
                $maxSpeed = number_format($liveData->filter(function ($query) {
                    return $query->Longitude > 0 && $query->Speed > 5;
                })->max('Speed'), 2);
                return view('pages.maps.view')->with([
                'vehicle' => $vehicle,
                'data' => $lastData,
                'lastLocation' => $lastLocation,
                'avgSpeed' => $avgSpeed,
                'maxSpeed' => $maxSpeed
                ]);
            } else {
            return view('pages.maps.view')->with([
                'vehicle' => DeviceMaster::with('locations', 'object')->get()
                ]);
            }
        }

    public function playbackDataByVehicle(Request $request) {
        $requestParams = ['date' => date('Ymd')];
        $apiResponse = $this->getAPIResponse($requestParams);
        $data = [];
        $location = [];
        $ignition = [];
        foreach ($apiResponse as $response) {
            // $response->PacketStatus == "L" &&
            if ($response->PacketStatus == 'L' && $response->Speed > 5) {
                if ($response->Longitude != 0 && $response->IMEI == $request->imei) {
                    $location[] = array(
                        'lat' => $response->Lattitude,
                        'lng' => $response->Longitude
                    );
                    $ignition[]['ign'] = $response->IgnitionStatus;
                }
            }
        }
        return response()->json(['path' => $location, 'ignition' => $ignition]);
    }

    public function track($imei) {
        $vehicle = DeviceMaster::where('imei', $imei)->with('locations', 'object')->first();
        $liveData = $this->getAPIResponse();
        $lastData = $liveData != null ? $liveData->where('IMEI', $imei)->last() : '';
        if($lastData == NULL) {
            Session::flash('error', 'No data found!');
            return redirect()->back();
        }
        $lastLocation = $lastData != null ? $this->getAddress($lastData->Lattitude, $lastData->Longitude) : "No location found.";
        $avgSpeed = number_format($liveData->filter(function ($query) {
            return $query->Longitude > 0 && $query->Speed > 5;
        })->avg('Speed'), 2);
        $maxSpeed = number_format($liveData->filter(function ($query) {
            return $query->Longitude > 0 && $query->Speed > 5;
        })->max('Speed'), 2);
        return view('pages.maps.track')->with([
            'vehicle' => $vehicle,
            'data' => $lastData,
            'lastLocation' => $lastLocation,
            'avgSpeed' => $avgSpeed,
            'maxSpeed' => $maxSpeed
        ]);
    }

    private function getAddress($long, $lat) {
        $client = new Client();
        $to_location = "$long,$lat";
        $apiRequest = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json?&key=AIzaSyDFqrV7p6S7j-eORKH7RHeOTEwFSZeuImc&latlng=' . trim($to_location) . '&sensor=false');
        if ($apiRequest->getStatusCode() === 200) {
            $data = collect(json_decode($apiRequest->getBody()->getContents()))['results'][0];
            return $data->formatted_address;
        } else {
            return 'Some error occured in making request to google server!';
        }
    }

    private function getAPIResponse() {

        $client = new Client();
        $url = 'http://localhost:3000/api/currentVehiclePacket';
        $apiRequest = $client->request('POST', $url, []);
        if ($apiRequest->getStatusCode() === 200) {
            $data = json_decode($apiRequest->getBody()->getContents());
            return new Collection($data->data);
        } else {
            return collect();
        }
    }

    private function filterResponse($json, $assoc = true) {
        $json = preg_replace('/,\s*([\]}])/m', '$1', $json);
        return json_decode($json, $assoc);
    }
}
