<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Session;

class OldHomeController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index() {
		// dd(Auth::user()->master->id);
		$vehicles  = DeviceMaster::select('id', 'imei', 'name')->whereHas('object', function($query) {
            if (Auth::user()->master->type->id == Role::SUPER_ADMIN) {
                $where = [];
            } else {
                $where = ['company_id' => Auth::user()->master->id];
            }
            return $query->where($where);
        })->get();
		return view('pages.dashboard')->with('vehicles', $vehicles);
	}

	
	/**
	 * Show the application Admin Profile Page.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function getDistanceBWLatLong($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo) {

		$long1 = deg2rad($longitudeFrom);
		$long2 = deg2rad($longitudeTo);
		$lat1 = deg2rad($latitudeFrom);
		$lat2 = deg2rad($latitudeTo);

		//Haversine Formula
		$dlong = $long2 - $long1;
		$dlati = $lat2 - $lat1;

		$val = pow(sin($dlati / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($dlong / 2), 2);

		$res = 2 * asin(sqrt($val));

		$radius = 3958.756;
		$data = $res * $radius;
		$headers = [];

		return $data;
	}

	/**
	 *
	 * Get Distance Method
	 */
	public function getDistance($from = '', $to = '', $ignition = 1) {
		$devices = [];
		$devices = DeviceMaster::groupBy('imei')->pluck('imei');
		// dd($devices);
		// dd($from, $to);
		/** $getDevices = json_decode(file_get_contents('http://13.233.241.178:3000/api/get/configured-imei'), true)['response']['data'];
		$deviceCollection = new Collection();
		$deviceCollection->push($getDevices);
		foreach ($deviceCollection[0] as $device) {
			$devices[] = $device['IMEI'];
		} **/
		//dd($devices);
		$totalRecordsBeforeExtraction = new Collection;

		// $totalRecords = DeviceData::where(function($query) use($from, $to, $ignition, $records){
		//   $query->where('PacketDateTime', '<', ($from != '' ? $from : Carbon::parse('today 12pm')));
		//   $query->where('PacketDateTime', '>=',  ($to != '' ? $to : Carbon::parse('yesterday 12pm')));
		// })->select('IMEI', 'DeltaDistance', 'Longitude', 'Lattitude')->get();

		// Specify the start date. This date can be any English textual format
		$date_from = $to;
		$date_from = strtotime($date_from) - 86400; // Convert date to a UNIX timestamp

		// Specify the end date. This date can be any English textual format
		$date_to = $from;
		$date_to = strtotime($date_to); // Convert date to a UNIX timestamp
		// dd($date_to, $date_from);
		// Loop from the start date to end date and output all dates inbetween
		$dateArray = array();
		for ($i = $date_from; $i <= $date_to; $i += 86400) {
			$dateArray[] = date('Ymd', $i);
			$item = json_decode($this->getApiResponseMethod('http://13.233.241.178:3000/api/getDeviceData', array(
				'date' => date('Ymd', $i),
			)), true)['response']['userData'];
			$totalRecordsBeforeExtraction->push($item);
		}
		if ($totalRecordsBeforeExtraction->count() == 0) {
			$item = json_decode($this->getApiResponseMethod('http://13.233.241.178:3000/api/getDeviceData', array(
				'date' => date('Ymd', $date_to),
			)), true)['response']['userData'];
			$totalRecordsBeforeExtraction->push($item);
		}
		$totalRecords = $totalRecordsBeforeExtraction->collapse();
		// $totalRecords->push($apiTotalRecords);
		// dd($totalRecords->count());
		// dd($totalRecords);
		$iteration_response = array();
		$return_collection = array();
		foreach ($devices as $device) {

			$dataToBeIterated = $totalRecords->where('IMEI', $device);
			$from_location = (isset($dataToBeIterated[0]['Lattitude'])
				? $dataToBeIterated[0]['Lattitude']
				: '0') . ',' . (isset($dataToBeIterated[0]['Longitude'])
				? $dataToBeIterated[0]['Longitude']
				: '0');
			$geoFromLocation = (isset($dataToBeIterated[0]['Lattitude']) && $dataToBeIterated[0]['Lattitude'] == '0') ? 'No Location Found' : file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?&key=AIzaSyDFqrV7p6S7j-eORKH7RHeOTEwFSZeuImc&latlng=' . trim($from_location) . '&sensor=false');
			// dd(json_decode($geoFromLocation, true)['results']);
			$iteration_response['from_location'] = ($geoFromLocation != "No Location Found" && json_decode($geoFromLocation, true)['results'] != []) ? json_decode($geoFromLocation, true)['results'][0]['formatted_address'] : "No Location Found";
			// dd($iteration_response['from_location']);
			$to_location = (isset($dataToBeIterated[count($dataToBeIterated) - 1]['Lattitude'])
				? $dataToBeIterated[count($dataToBeIterated) - 1]['Lattitude']
				: '0') . ',' . (isset($dataToBeIterated[count($dataToBeIterated) - 1]['Longitude'])
				? $dataToBeIterated[count($dataToBeIterated) - 1]['Longitude']
				: '0');
			$geoToLocation = (isset($dataToBeIterated[count($dataToBeIterated) - 1]['Lattitude']) && $dataToBeIterated[count($dataToBeIterated) - 1]['Lattitude'] == '0') ? 'No Location Found' : file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?&key=AIzaSyDFqrV7p6S7j-eORKH7RHeOTEwFSZeuImc&latlng=' . trim($to_location) . '&sensor=false');
			$iteration_response['to_location'] = ($geoFromLocation != "No Location Found" && json_decode($geoToLocation, true)['results'] != []) ? json_decode($geoToLocation, true)['results'][0]['formatted_address'] : "No Location Found";
			// dd($dataToBeIterated->where('Lattitude', '!=', 0)->max('Speed'));
			// dd($from_location, $to_location);
			$device_id = DeviceMaster::where('imei', $device)->first()->id;
			$object = ObjectMaster::where('device_id', $device_id)->first();
			$iteration_response['object'] = $object->name;
			$iteration_response['reseller'] = UserMaster::find($object->reseller_id)->name;
			$iteration_response['company'] = UserMaster::find($object->company_id)->name;
			$iteration_response['vehicle'] = $device;
			$iteration_response['distance'] = number_format(($dataToBeIterated->filter(function ($query) {
				return $query['Speed'] == 0 && $query['Lattitude'] != 0;
			})->sum('DeltaDistance') / 1000), 3) . ' KM';
			$iteration_response['avg'] = number_format($dataToBeIterated->where('Speed', '>', 5)->where('Lattitude', '!=', 0)->avg('Speed'), 3) . ' KM / H';
			$iteration_response['max'] = number_format($dataToBeIterated->where('Lattitude', '!=', 0)->max('Speed'), 3) . ' KM / H';
			// dd($iteration_response['reseller']);
			$return_collection[] = $iteration_response;
			// $dataToBeIterated = '';
		}
		// dd($return_collection);
		return $return_collection;
	}

	private function getApiResponseMethod($url, $params) {
		// dd($params);
		// $postData = '';
		// //create name value pairs seperated by &
		// foreach ($params as $k => $v) {
		// 	$postData .= $k . '=' . $v . '&';
		// }
		// $postData = rtrim($postData, '&');
		// // dd($postData);
		// $curl = curl_init();
		// curl_setopt($curl, CURLOPT_URL, $url);
		// curl_setopt($curl, CURLOPT_HEADER, false);
		// curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		// curl_setopt($curl, CURLOPT_POST, true);
		// curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
		// $last_result = curl_exec($curl);
		// $err = curl_error($curl);
		// curl_close($curl);
		// dd($last_result);
		$options = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($params)
			)
		);
		$context  = stream_context_create($options);
		$last_result = file_get_contents($url, false, $context);

		$result = json_encode($this->filterResponse($last_result));
		if (strlen($result) == 0) {
			return [];
		} else {
			return $result;
		}
	}

	private function filterResponse($json, $assoc = true) {
		$json = preg_replace('/,\s*([\]}])/m', '$1', $json);
		return json_decode($json, $assoc);
	}

	/**
	 * Show the application Admin Profile Page.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function user($type) {
		// dd(Auth::user()->master->role_id);
		$timezones = TimezoneMaster::all();
		if (Auth::user()->master->role_id == 1):
			$userMaster = UserMaster::where(['role_id' => $type])->with('parent')->get();
		else:
			$userMasters = UserMaster::where(['role_id' => $type])->with(['parent' => function ($query) {
				$query->where('id', Auth::user()->id);
			}])->get();
			
			$userMaster = collect();
			foreach ($userMasters as $value) {
				if ($value->parent != null) {
					$userMaster->push($value);
				}
			}
		endif;
		$pageName = Role::find($type)->name;
		// dd($userMaster);
		return view('pages.users.view')->with([
			'timezones' => $timezones,
			'userMaster' => $userMaster,
			'page_name' => $pageName,
			'userType' => $type,
		]);
	}

	/**
	 * Display a listing of the resource.
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function userSettings($userType, $id) {
		$user_id = decrypt($id);
		$user = UserMaster::find($user_id);
		$userRules = UserRuleSetting::where('user_id', $user_id)->get();
		$alertTypes = AlertTypeMaster::all();
		$maps = MapMaster::where('status', 1)->get();
		$userMaps = UserMapSetting::where('user_id', $user_id)->get();
		return view('pages.users.settings')->with([
			'user' => $user,
			'userRules' => $userRules,
			'alerttypes' => $alertTypes,
			'maps' => $maps,
			'userMaps' => $userMaps,
		]);
	}

	/**
	 * Display a listing of the resource.
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function addCompanyUser($userType, $id) {
		$company_id = decrypt($id);
		// dd($company_id);
		$branches = UserMaster::where(['parent_id' => $company_id, 'role_id' => Role::BRANCH])->get();
		$users = UserMaster::where(['parent_id' => $company_id, 'role_id' => Role::USER])->whereIn('parent_id', $branches->pluck('id'))->get();
		$company = UserMaster::find($company_id);
		$countries = Country::all();
		$states = City::all()->unique('district');
		$cities = City::all();
		$timezones = TimezoneMaster::all();
		// dd($users);
		return view('pages.company.add-user')->with([
			'branches' => $branches,
			'company' => $company,
			'countries' => $countries,
			'states' => $states,
			'cities' => $cities,
			'timezones' => $timezones,
			'users' => $users,
		]);
	}

	/**
	 * Display a listing of the resource travel details.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function travelDetails(Request $request) {
		$deviceDatas = $this->getDistance(Carbon::today(), Carbon::yesterday());
		/**
		 * Listing Columns
		 */
		$columns = array(
			'Record ID',
			'Reseller',
			'Company',
			'Object',
			'Driver',
			'IMEI No',
			'Start Location',
			'End Location',
			'Distance',
			'Running',
			'Idle',
			'Stop',
			'Inactive',
			'Max Stoppage',
			'No of Idle',
			'AVG',
			'MAX',
			'Over Speed',
			'Alert',
			'Actions',
		);
		/**
		 * Listing Columns Ends
		 */

		/**
		 * Listing Rows
		 */
		$rows = array();
		// dd($this->getDistance());
		foreach ($deviceDatas as $iteration => $deviceData) {
			// dd($deviceData);
			$rows[] = array(
				($iteration + 1),
				$deviceData['reseller'],
				$deviceData['company'],
				$deviceData['object'],
				'',
				$deviceData['vehicle'],
				$deviceData['from_location'],
				$deviceData['to_location'],
				$deviceData['distance'],
				'',
				'',
				'',
				'',
				'',
				'',
				$deviceData['avg'],
				$deviceData['max'],
				'',
				'',
				'',
			);
		}
		/**
		 * Listing Rows Ends
		 */

		/**
		 *
		 * Laravel Pagination On Array
		 */

		// Get current page form url e.x. &page=1
		$currentPage = LengthAwarePaginator::resolveCurrentPage();

		// Create a new Laravel collection from the array data
		$itemCollection = collect($deviceDatas);

		// Define how many items we want to be visible in each page
		$perPage = 25;

		// Slice the collection to get the items to display in current page
		$currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

		// Create our paginator and pass it to the view
		$paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);

		// set url path for generted links
		$paginatedItems->setPath($request->url());

		// dd($rows);
		$vars = ['columns' => $columns, 'rows' => $rows, 'data' => $paginatedItems, 'pageName' => 'TRAVEL SUMMARY'];
		// dd($vars);
		return view('pages.datatables')->with($vars);
	}

	/**
	 * Display a listing of the resource travel details.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function travelDetailsByDate(Request $request) {
		$from = Carbon::parse($request->from_date)->format('Y-m-d 12:00:00');
		$to = Carbon::parse($request->to_date)->format('Y-m-d 24:00:00');
		$deviceDatas = $this->getDistance($from, $to);
		/**
		 * Listing Columns
		 */
		// dd($deviceDatas);
		$columns = array(
			'Record ID',
			'Company',
			'Branch',
			'Object',
			'Driver',
			'IMEI No',
			'Start Location',
			'End Location',
			'Distance',
			'Running',
			'Idle',
			'Stop',
			'Inactive',
			'Max Stoppage',
			'No of Idle',
			'AVG',
			'MAX',
			'Over Speed',
			'Alert',
			'Actions',
		);
		/**
		 * Listing Columns Ends
		 */

		/**
		 * Listing Rows
		 */
		$rows = array();
		// dd($this->getDistance());
		foreach ($deviceDatas as $iteration => $deviceData) {
			// dd($deviceData);
			$rows[] = array(
				($iteration + 1),
				'',
				'',
				'',
				'',
				$deviceData['vehicle'],
				$deviceData['from_location'],
				$deviceData['to_location'],
				$deviceData['distance'],
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
			);
		}
		/**
		 * Listing Rows Ends
		 */

		/**
		 *
		 * Laravel Pagination On Array
		 */

		// Get current page form url e.x. &page=1
		$currentPage = LengthAwarePaginator::resolveCurrentPage();

		// Create a new Laravel collection from the array data
		$itemCollection = collect($deviceDatas);

		// Define how many items we want to be visible in each page
		$perPage = 25;

		// Slice the collection to get the items to display in current page
		$currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

		// Create our paginator and pass it to the view
		$paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);

		// set url path for generted links
		$paginatedItems->setPath($request->url());

		// dd($rows);
		$vars = ['columns' => $columns, 'rows' => $rows, 'data' => $paginatedItems, 'pageName' => 'TRAVEL SUMMARY'];
		// dd($vars);
		return view('pages.datatables')->with($vars);
	}

	/**
	 * Display a listing of the resource travel history.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function travelHistory() {
		$deviceDatas = DeviceData::paginate(100);
		/**
		 * Listing Columns
		 */
		$columns = array(
			'Record ID',
			'Vehicle Number',
			'Vendor ID',
			'Device IMEI No',
			'Device Type',
			'Firmware Version',
			'GPS Status',
			'Longitude',
			'Latitude',
			'Packet Type',
			'Packet Data Time',
			'Packet Status',
			'Speed',
			'Heading',
			'Number Of Satalites',
			'Altitude',
			'PDOP',
			'HDOP',
			'Network Operator',
			'Ignition Status',
			'Main Power Status',
			'Main Input Voltage',
			'Internal Bettery Voltage',
			'Emergency Status',
			'Temper Alert',
			'GSM Signal Strength',
			'MCC',
			'MNC',
			'LAC',
			'Cell ID',
			'Digital Input 1',
			'Digital Input 2',
			'Digital Input 3',
			'Digital Input 4',
			'Digital Output 1',
			'Digital Output 2',
			'Analog Input 1',
			'Analog Input 2',
			'Delta Distance',
			'OTA Response',
			'Message Time',
			'Frame Number',
			'Record Created On',
			'Actions',
		);
		/**
		 * Listing Columns Ends
		 */

		/**
		 * Listing Rows
		 */
		$rows = array();
		foreach ($deviceDatas as $iteration => $deviceData) {
			$rows[] = array(
				($iteration + 1),
				$deviceData->VehicleNumber,
				$deviceData->VendorId,
				$deviceData->IMEI,
				$deviceData->DeviceType,
				$deviceData->FirmWareVersion,
				$deviceData->GPSStatus,
				$deviceData->Longitude,
				$deviceData->Lattitude,
				$deviceData->PacketType,
				$deviceData->PacketDateTime,
				$deviceData->PacketStatus,
				$deviceData->Speed,
				$deviceData->Heading,
				$deviceData->NoOfSatelites,
				$deviceData->Altitude,
				$deviceData->PDOP,
				$deviceData->HDOP,
				$deviceData->NetworkOperatorName,
				$deviceData->IgnitionStatus,
				$deviceData->MainPowerStatus,
				$deviceData->MainInputVoltage,
				$deviceData->InternalBatteryVoltage,
				$deviceData->EmergencyStatus,
				$deviceData->TamperAlert,
				$deviceData->GSMSignalStrength,
				$deviceData->MCC,
				$deviceData->MNC,
				$deviceData->LAC,
				$deviceData->CellID,
				$deviceData->DigitalInput1,
				$deviceData->DigitalInput2,
				$deviceData->DigitalInput3,
				$deviceData->DigitalInput4,
				$deviceData->DigitalOutput1,
				$deviceData->DigitalOutput2,
				$deviceData->AnalogInput1,
				$deviceData->AnalogInput2,
				$deviceData->DeltaDistance,
				$deviceData->OTAResponse,
				$deviceData->message_time,
				$deviceData->FrameNumber,
				$deviceData->created_at,
				'',
			);
		}
		/**
		 * Listing Rows Ends
		 */

		// dd($rows);
		$vars = ['columns' => $columns, 'rows' => $rows, 'data' => $deviceDatas, 'pageName' => 'TRAVEL HISTORY'];
		// dd($vars);
		return view('pages.datatables')->with($vars);
	}

	/**
	 * Display a listing of the resource trip.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function tripDetails() {
		$deviceDatas = DeviceData::paginate(100);
		/**
		 * Listing Columns
		 */
		$columns = array(
			'Record ID',
			'Vehicle Number',
			'Vendor ID',
			'Device IMEI No',
			'Device Type',
			'Firmware Version',
			'GPS Status',
			'Longitude',
			'Latitude',
			'Packet Type',
			'Packet Data Time',
			'Packet Status',
			'Speed',
			'Heading',
			'Number Of Satalites',
			'Altitude',
			'PDOP',
			'HDOP',
			'Network Operator',
			'Ignition Status',
			'Main Power Status',
			'Main Input Voltage',
			'Internal Bettery Voltage',
			'Emergency Status',
			'Temper Alert',
			'GSM Signal Strength',
			'MCC',
			'MNC',
			'LAC',
			'Cell ID',
			'Digital Input 1',
			'Digital Input 2',
			'Digital Input 3',
			'Digital Input 4',
			'Digital Output 1',
			'Digital Output 2',
			'Analog Input 1',
			'Analog Input 2',
			'Delta Distance',
			'OTA Response',
			'Message Time',
			'Frame Number',
			'Record Created On',
			'Actions',
		);
		/**
		 * Listing Columns Ends
		 */

		/**
		 * Listing Rows
		 */
		$rows = array();
		foreach ($deviceDatas as $iteration => $deviceData) {
			$rows[] = array(
				($iteration + 1),
				$deviceData->VehicleNumber,
				$deviceData->VendorId,
				$deviceData->IMEI,
				$deviceData->DeviceType,
				$deviceData->FirmWareVersion,
				$deviceData->GPSStatus,
				$deviceData->Longitude,
				$deviceData->Lattitude,
				$deviceData->PacketType,
				$deviceData->PacketDateTime,
				$deviceData->PacketStatus,
				$deviceData->Speed,
				$deviceData->Heading,
				$deviceData->NoOfSatelites,
				$deviceData->Altitude,
				$deviceData->PDOP,
				$deviceData->HDOP,
				$deviceData->NetworkOperatorName,
				$deviceData->IgnitionStatus,
				$deviceData->MainPowerStatus,
				$deviceData->MainInputVoltage,
				$deviceData->InternalBatteryVoltage,
				$deviceData->EmergencyStatus,
				$deviceData->TamperAlert,
				$deviceData->GSMSignalStrength,
				$deviceData->MCC,
				$deviceData->MNC,
				$deviceData->LAC,
				$deviceData->CellID,
				$deviceData->DigitalInput1,
				$deviceData->DigitalInput2,
				$deviceData->DigitalInput3,
				$deviceData->DigitalInput4,
				$deviceData->DigitalOutput1,
				$deviceData->DigitalOutput2,
				$deviceData->AnalogInput1,
				$deviceData->AnalogInput2,
				$deviceData->DeltaDistance,
				$deviceData->OTAResponse,
				$deviceData->message_time,
				$deviceData->FrameNumber,
				$deviceData->created_at,
				'',
			);
		}
		/**
		 * Listing Rows Ends
		 */

		// dd($rows);
		$vars = ['columns' => $columns, 'rows' => $rows, 'data' => $deviceDatas, 'pageName' => 'TRIP SUMMERY'];
		// dd($vars);
		return view('pages.datatables')->with($vars);
	}

	/**
	 * Display a listing of the resource add objects.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function addObject() {
		$resellers = UserMaster::resellers()->get();
		$companies = UserMaster::companies()->get();
		$branches = UserMaster::branches()->get();
		$deviceMaster = DeviceMaster::all();
		$timezone = TimezoneMaster::all();
		// dd(array('reseller' => $resellers), array('companies', $companies), array('branches', $branches), $deviceMaster, $timezone);
		return view('pages.vehicles.add')->with([
			'resellers' => $resellers,
			'companies' => $companies,
			'branches' => $branches,
			'devices' => $deviceMaster,
			'timezone' => $timezone,
		]);
	}

	/**
	 * Display a listing of the resource objects.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function objects() {
		$deviceDatas = ObjectMaster::with('device_master')->paginate(100);
		/**
		 * Listing Columns
		 */
		$columns = array(
			'Record ID',
			'Reseller',
			'Company',
			'Branch',
			'Name',
			'Registration Number',
			'Device Type',
			'IMEI Number',
			'SIM Number',
			'Timezone',
			'Plate Number',
			'Object Type',
			'Manufactured',
			'Purchaged',
			'Installation',
			'Odometer',
			'Record Created On',
			'Actions',
		);
		/**
		 * Listing Columns Ends
		 */
		// dd($deviceDatas);
		/**
		 * Listing Rows
		 */
		$rows = array();
		foreach ($deviceDatas as $iteration => $deviceData) {
			$rows[] = array(
				($iteration + 1),
				UserMaster::find($deviceData->reseller_id)->name,
				UserMaster::find($deviceData->company_id)->name,
				UserMaster::find($deviceData->company_branch_id)->name,
				$deviceData->name,
				$deviceData->device_master->registration_number,
				$deviceData->device_type,
				$deviceData->device_master->imei,
				$deviceData->device_master->sim_number,
				TimezoneMaster::find($deviceData->device_timezone)->type,
				$deviceData->plate_number,
				$deviceData->object_type,
				$deviceData->manufacture_date,
				$deviceData->purchase_date,
				$deviceData->installation_date,
				$deviceData->odometer,
				$deviceData->created_at,
				'',
			);
		}
		/**
		 * Listing Rows Ends
		 */
		$vars = ['columns' => $columns, 'rows' => $rows, 'data' => $deviceDatas, 'pageName' => 'OBJECTS'];
		// dd($vars);
		return view('pages.datatables')->with($vars);
	}
	// CRON JOBS TESTING

	public function cronTravelReport($ignition = 1) {

		$devices = DeviceMaster::groupBy('imei')->pluck('imei');
		$totalRecordsBeforeExtraction = new Collection;
		$item = json_decode($this->getApiResponseMethod('http://13.233.241.178:3000/api/getDeviceData', array(
			'date' => date('Ymd'),
		)), true)['response']['userData'];
		$totalRecordsBeforeExtraction->push($item);
		$totalRecords = $totalRecordsBeforeExtraction->collapse();
		// dd($totalRecords->first());
		$iteration_response = array();
		$return_collection = array();
		foreach ($devices as $device) {
			$dataToBeIterated = $totalRecords->where('IMEI', $device);
			$from_location = (isset($dataToBeIterated[0]['Lattitude'])
				? $dataToBeIterated[0]['Lattitude']
				: '0') . ',' . (isset($dataToBeIterated[0]['Longitude'])
				? $dataToBeIterated[0]['Longitude']
				: '0');

			$geoFromLocation = $from_location == '0,0' ? 'No Location Found' : file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?&key=AIzaSyDFqrV7p6S7j-eORKH7RHeOTEwFSZeuImc&latlng=' . trim($from_location) . '&sensor=false');
			$iteration_response['from_location'] = json_decode($geoFromLocation, true)['results'][0]['formatted_address'];

			$to_location = (isset($dataToBeIterated[count($dataToBeIterated) - 1]['Lattitude'])
				? $dataToBeIterated[count($dataToBeIterated) - 1]['Lattitude']
				: '0') . ',' . (isset($dataToBeIterated[count($dataToBeIterated) - 1]['Longitude'])
				? $dataToBeIterated[count($dataToBeIterated) - 1]['Longitude']
				: '0');

			$geoToLocation = $to_location == '0,0' ? 'No Location Found' : file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?&key=AIzaSyDFqrV7p6S7j-eORKH7RHeOTEwFSZeuImc&latlng=' . trim($to_location) . '&sensor=false');
			$iteration_response['to_location'] = json_decode($geoToLocation, true)['results'][0]['formatted_address'];
			$device_id = DeviceMaster::where('imei', $device)->first()->id;
			$object = ObjectMaster::where('device_id', $device_id)->first();
			$iteration_response['object'] = $object->name;
			$iteration_response['reseller'] = UserMaster::find($object->reseller_id)->name;
			$iteration_response['company'] = UserMaster::find($object->company_id)->name;
			$iteration_response['vehicle'] = $device;
			$iteration_response['distance'] = number_format(($dataToBeIterated->sum('DeltaDistance') / 1000), 3); // . ' KM'
			$iteration_response['max'] = number_format($dataToBeIterated->max('Speed'), 3); //  . ' KM/H'

			// Get Idle Array
			// Get Running Array
			// Get Stoppage Array
			// Get Inactive Array

			// $travelReport = new TravelDaywiseReport;
			// $travelReport->reseller = $iteration_response['reseller'];
			// $travelReport->company = $iteration_response['company'];
			// $travelReport->object = $iteration_response['object'];
			// $travelReport->imei = $iteration_response['vehicle'];
			// $travelReport->start_location = $iteration_response['from_location'];
			// $travelReport->end_location = $iteration_response['to_location'];
			// $travelReport->distance = $iteration_response['distance'];
			// $travelReport->idle = $iteration_response['idle'];
			// $travelReport->running = $iteration_response['running'];
			// $travelReport->stop = $iteration_response['stop'];
			// $travelReport->inactive = $iteration_response['inactive'];
			// $travelReport->max_stoppage = $iteration_response['max_stoppage'];
			// $travelReport->no_of_idle = $iteration_response['no_of_idle'];
			// $travelReport->average = $iteration_response['average'];
			// $travelReport->max = $iteration_response['max'];
			// $travelReport->save();

			$return_collection[] = $iteration_response;
		}
		return $iteration_response;
	}

}