<?php
namespace App\Repositories\Eloquent;

use App\Models\DeviceMaster;
use App\Models\ObjectMaster;
use App\Models\Role;
use App\Repositories\Contract\TripReportInterface as TripContract;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Auth;

class TripReportRepository_old implements TripContract
{
    private $tripURI = 'http://localhost:3000/api/trip-report-current';
    private $tripFilteredURI = 'http://localhost:3000/api/trip-report';
    /**
     * TRIP REPORT CURRENT
     */
   /* public function current($request, $client) {
        $response = new Collection;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $per_page = 25;
        if (Auth::user()->master->type->id == Role::SUPER_ADMIN) {
            $where = [];
        } elseif(Auth::user()->master->type->id == Role::BRANCH) {
            $where = ['company_branch_id' => Auth::user()->id];
        } else {
            $where = ['company_id' => Auth::user()->master->id];
        }
        $requestIMEIs = ObjectMaster::where($where)->with('device_master')->get()->pluck('device_master.imei')->toArray();
        $requestParams = [
            'connect_timeout' => 10,
            'form_params' => [
                'imei' => json_encode($requestIMEIs)
            ]
        ];
        // print_r($requestParams);exit;
        $httpResponse = $client->request('POST', $this->tripURI, $requestParams);
        if ($httpResponse->getStatusCode() === 200) {
            $data = collect(json_decode($httpResponse->getBody()->getContents())->response->data);
        }
        $devices = DeviceMaster::whereIn('imei', $data->pluck('IMEI')->toArray())->whereHas('object', function($query) {
            if (Auth::user()->master->type->id == Role::SUPER_ADMIN) {
                return $query;
            } else {
                return $query->where('company_id', Auth::user()->master->id);
            }
        })->with('object.company', 'object.branch')->get();
        if ($data->count()) {
            $response = $this->getTripReport($devices->slice(($currentPage-1) * $per_page, $per_page), $data);
        }
        $responseData = new LengthAwarePaginator($response, $devices->count(), $per_page);
        $responseData->setPath($request->url());
        return $responseData;
    }*/

    public function current($request, $client) {
        $pageNo = isset($request->pageNo) ? $request->pageNo : 1;
        $response = new Collection;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $per_page = 25;
        if (Auth::user()->master->type->id == Role::SUPER_ADMIN) {
            $where = [];
        } elseif(Auth::user()->master->type->id == Role::BRANCH) {
            $where = ['company_branch_id' => Auth::user()->id];
        } else {
            $where = ['company_id' => Auth::user()->master->id];
        }
        $requestIMEIs = ObjectMaster::where($where)->with('device_master')->get()->pluck('device_master.imei')->toArray();
        $requestParams = [
            'connect_timeout' => 10,
            'form_params' => [
                'imei' => json_encode($requestIMEIs),
                'pageNo' => $pageNo
            ]
        ];
        // print_r($requestParams);exit;
        $httpResponse = $client->request('POST', $this->tripURI, $requestParams);
        if ($httpResponse->getStatusCode() === 200) {
            $data = collect(json_decode($httpResponse->getBody()->getContents())->response->data);
        }
        //dd($data);
        $devices = DeviceMaster::whereIn('imei', $data->pluck('IMEI')->toArray())->whereHas('object', function($query) {
            if (Auth::user()->master->type->id == Role::SUPER_ADMIN) {
                return $query;
            } else {
                return $query->where('company_id', Auth::user()->master->id);
            }
        })->with('object.company', 'object.branch')->get();
        if ($data->count()) {
            $response = $this->getTripReport($devices->slice(($currentPage-1) * $per_page, $per_page), $data);
        }
        $responseData = new LengthAwarePaginator($response, $devices->count(), $per_page);
        $responseData->setPath($request->url());
        return $responseData;
    }


    /**
     * TRIP REPORT WITH FILTERS
     */
    public function withFilters($request, $client){
        //
    }


     // GET TRIP REPORT
     private function getTripReport($devices, $data) {
        $response = new Collection;
        foreach ($devices->chunk(10) as $deviceChunk) {
            foreach ($deviceChunk as $device) {
                $vehicleResponse = new Collection;
                if ($data != null && $data->where('IMEI', $device->imei)->count() > 0) {
                    $vehicleInstances = $data->where('IMEI', $device->imei)->first();
                    if (1) {
                        $vehicleResponse->imei = $device->imei;
                        $vehicleResponse->company = $device->object->company->name;
                        $vehicleResponse->branch = $device->object->branch->name;
                        $vehicleResponse->date = date('d M Y, H:i:s');
                        $vehicleResponse->object = $device->object->plate_number;
                        $vehicleResponse->distance = number_format($vehicleInstances->TotalDistance, 2);
                        $vehicleResponse->running = ($vehicleInstances->TotalRunningTime == 0 ? $vehicleInstances->TotalRunningTime : (round($vehicleInstances->TotalRunningTime / 60) .":". substr($vehicleInstances->TotalRunningTime % 60, 1)));
                        $vehicleResponse->stop = ($vehicleInstances->TotalStopTime == 0 ? $vehicleInstances->TotalStopTime : (round($vehicleInstances->TotalStopTime / 60) .":". substr($vehicleInstances->TotalStopTime % 60, 1)));
                        $vehicleResponse->average_speed = number_format($vehicleInstances->TotalAverageSpeed, 2);
                        $vehicleResponse->max_speed = isset($vehicleInstances->max_speed) ? number_format($vehicleInstances->max_speed, 2) : 'NA';
                        $vehicleResponse->start_ign_on = isset($vehicleInstances->start_ign_on) ? $vehicleInstances->start_ign_on : 'NA';
                        $vehicleResponse->end_ign_off = isset($vehicleInstances->end_ign_off) ? $vehicleInstances->end_ign_off : 'NA';
                        $trips = collect();
                        $vehicleTripCollection = new Collection($vehicleInstances->TripDetailSegmnet);
                        $formattedCollectionVehicleTrip = $vehicleTripCollection->map(function($item){
                            return $item[0];
                        });
                        foreach($formattedCollectionVehicleTrip->chunk(10) as $vehicleTripChunk){
                            foreach($vehicleTripChunk as $vehicleTrip) {
                                $tripCollection = new Collection();
                                $tripCollection->imei = ($vehicleTrip->IMEI);
                                $tripCollection->from_location = isset($vehicleTrip->from_location) ? $vehicleTrip->from_location : 'NA';
                                $tripCollection->to_location = isset($vehicleTrip->to_location) ? $vehicleTrip->to_location : 'NA';
                                $tripCollection->distance =  $vehicleTrip->TotalDistane;
                                $tripCollection->running = ($vehicleTrip->TotalRunningTime == 0 ? $vehicleTrip->TotalRunningTime : (round($vehicleTrip->TotalRunningTime / 60) .":". substr($vehicleTrip->TotalRunningTime % 60, 1)));
                                $tripCollection->stop = ($vehicleTrip->TotalStopTime == 0 ? $vehicleTrip->TotalStopTime : (round($vehicleTrip->TotalStopTime / 60) .":". substr($vehicleTrip->TotalStopTime % 60, 1)));
                                $tripCollection->average_speed = number_format($vehicleTrip->AverageSpeed, 2);
                                $trips->push($tripCollection);
                            }
                        }
                        $vehicleResponse->trips = $trips;
                    }
                }
                if ($vehicleResponse->distance > 0) {
                    $response->push($vehicleResponse);
                }
            }
        }
        return $response;
    }

}
