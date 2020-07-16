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
use \GuzzleHttp\Client;
use \GuzzleHttp\Exception\ClientErrorResponseException;
use Session;

class HomeController extends Controller {
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
		$response = new Collection;
		// dd(Auth::user()->master->id);
		$vehicles  = DeviceMaster::select('id', 'imei', 'name')->whereHas('object', function($query) {
            if (Auth::user()->master->type->id == Role::SUPER_ADMIN) {
                $where = [];
            } else {
                $where = ['company_id' => Auth::user()->master->id];
            }
            return $query->where($where);
		})->get();
		$response = $this->getVehicleData($vehicles);
		return view('pages.dashboard')->with([
			'vehicles' => $vehicles, 
			'distanceData' => $response->distanceData, 
			'vehicleStatuses' => $response->vehicleStatuses
		]);
	}

	private function getVehicleData($vehicles) {
		$client = new Client();
		$lessThan50 = 0;
		$range50to100 = 0;
		$range100to200 = 0;
		$range200to500 = 0;
		$greaterThan500 = 0;
		$running = 0;
		$stop = 0;
		$inactive = 0;
		$idle = 0;
		$nodata = 0;
		
		try {
			$httpResponseDistance = $client->request('POST', 'http://localhost:3000/api/currentVehicleReport', []);
		} catch (\Throwable $th) {
			$response['distanceData'] = (object) [
				"lessThan50" => 0,
				"range50to100" => 0,
				"range100to200" => 0,
				"range200to500" => 0,
				"greaterThan500" => 0
			];
			$response['vehicleStatuses'] = (object) [
				'running' => 0,
				'stop' => 0,
				'idle' => 0,
				'inactive' => 0,
				'nodata' => 0
			];
			Session::flash('error', 'Something went wrong!');
			return ((object) $response);
		}
		
		if ($httpResponseDistance->getStatusCode() === 200) {
			$dataDistance = collect(json_decode($httpResponseDistance->getBody()->getContents())->data);
		}
		foreach ($vehicles as $vehicle) {
			foreach ($dataDistance as $item) {
				if ($vehicle->imei == $item->IMEI) {
					$distance = (int) number_format(($item->TotalDistane/1000), 2);
					$vehicleStatus = $item->VehicleStatus;
					if ($distance < 50) {
						$lessThan50++;
					} elseif($distance > 50 && $distance > 100){
						$range50to100++;
					} elseif($distance > 100 && $distance > 200){
						$range100to200++;
					} elseif($distance > 200 && $distance > 500){
						$range100to500++;
					} elseif($distance > 500){
						$greaterThan500++;
					}

					if (strtolower($vehicleStatus) == "running") {
						$running++;
					} elseif (strtolower($vehicleStatus) == 'stop') {
						$stop++;
					} elseif (strtolower($vehicleStatus) == 'idle') {
						$idle++;
					} elseif (strtolower($vehicleStatus) ==  'inactive'){
						$inactive++;
					} else {
						$nodata++;
					}
				}
			}
		}
		$response['distanceData'] = (object) [
			"lessThan50" => $lessThan50,
			"range50to100" => $range50to100,
			"range100to200" => $range100to200,
			"range200to500" => $range200to500,
			"greaterThan500" => $greaterThan500
		];
			$response['vehicleStatuses'] = (object) [
			'running' => $running,
			'stop' => $stop,
			'idle' => $idle,
			'inactive' => $inactive,
			'nodata' => $nodata
		];
		// dd($response);
		return ((object) $response);
	}
}