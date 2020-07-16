<?php

namespace App\Console\Commands;

use App\Models\TravelDaywiseReport;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class TravelReportDaywise extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'cron:travelreportdaywise';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Saved Daywise Records of all vehicles.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {

		$devices = [];
		$getDevices = json_decode(file_get_contents('http://13.233.241.178:3000/api/get/configured-imei'), true)['response']['data'];
		$deviceCollection = new Collection();
		$deviceCollection->push($getDevices);
		foreach ($deviceCollection[0] as $device) {
			$devices[] = $device['IMEI'];
		}
		// dd($devices);
		// $devices = ['868728030790924'];
		$totalRecordsBeforeExtraction = new Collection;
		$item = json_decode($this->getApiResponseMethod('http://13.233.241.178:3000/api/getDeviceData', array(
			'date' => '20190912',
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
			$geoFromLocation = (isset($dataToBeIterated[0]['Lattitude']) && $dataToBeIterated[0]['Lattitude'] == '0') ? 'No Location Found' : file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?&key=AIzaSyDFqrV7p6S7j-eORKH7RHeOTEwFSZeuImc&latlng=' . trim($from_location) . '&sensor=false');
			// dd(json_decode($geoFromLocation, true)['results']);
			$iteration_response['from_location'] = ($geoFromLocation != "No Location Found" && count(json_decode($geoFromLocation, true)['results']) > 0) ? json_decode($geoFromLocation, true)['results'][0]['formatted_address'] : "No Location Found";
			// dd($iteration_response['from_location']);
			$to_location = (isset($dataToBeIterated[count($dataToBeIterated) - 1]['Lattitude'])
				? $dataToBeIterated[count($dataToBeIterated) - 1]['Lattitude']
				: '0') . ',' . (isset($dataToBeIterated[count($dataToBeIterated) - 1]['Longitude'])
				? $dataToBeIterated[count($dataToBeIterated) - 1]['Longitude']
				: '0');
			$geoToLocation = (isset($dataToBeIterated[count($dataToBeIterated) - 1]['Lattitude']) && $dataToBeIterated[count($dataToBeIterated) - 1]['Lattitude'] == '0') ? 'No Location Found' : file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?&key=AIzaSyDFqrV7p6S7j-eORKH7RHeOTEwFSZeuImc&latlng=' . trim($to_location) . '&sensor=false');
			$iteration_response['to_location'] = ($geoFromLocation != "No Location Found" && count(json_decode($geoToLocation, true)['results']) > 0) ? json_decode($geoToLocation, true)['results'][0]['formatted_address'] : "No Location Found";
			$iteration_response['object'] = '';
			$iteration_response['reseller'] = '';
			$iteration_response['company'] = '';
			$iteration_response['vehicle'] = $device;
			$iteration_response['distance'] = number_format(($dataToBeIterated->sum('DeltaDistance') / 1000), 2); // . ' KM'
			// filter(function ($query) {
			// 	return $query['Speed'] == 0 && $query['Lattitude'] != 0;
			// })->
			$iteration_response['avg'] = number_format($dataToBeIterated->where('Speed', '>', 5)->where('Lattitude', '!=', 0)->avg('Speed'), 2); //  . ' KM / H'
			$iteration_response['max'] = number_format($dataToBeIterated->where('Lattitude', '!=', 0)->max('Speed'), 2); //  . ' KM / H'
			$travelReport = new TravelDaywiseReport;
			$travelReport->reseller = $iteration_response['reseller'];
			$travelReport->company = $iteration_response['company'];
			$travelReport->object = $iteration_response['object'];
			$travelReport->imei = $iteration_response['vehicle'];
			$travelReport->start_location = $iteration_response['from_location'];
			$travelReport->end_location = $iteration_response['to_location'];
			$travelReport->distance = $iteration_response['distance'];
			// $travelReport->idle = $iteration_response['idle'];
			// $travelReport->running = $iteration_response['running'];
			// $travelReport->stop = $iteration_response['stop'];
			// $travelReport->inactive = $iteration_response['inactive'];
			// $travelReport->max_stoppage = $iteration_response['max_stoppage'];
			// $travelReport->no_of_idle = $iteration_response['no_of_idle'];
			$travelReport->average = $iteration_response['avg'];
			$travelReport->max = $iteration_response['max'];
			$travelReport->save();
		}

		// Save Data here.

		$this->info('Daily Report Saved Successfully!!');
	}

// Custom Functions
	private function getApiResponseMethod($url, $params) {
		// dd($params);
		$postData = '';
		//create name value pairs seperated by &
		foreach ($params as $k => $v) {
			$postData .= $k . '=' . $v . '&';
		}
		$postData = rtrim($postData, '&');
		// dd($postData);
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
		$last_result = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		// dd($last_result);
		$result = json_encode($this->filterResponse($last_result));
		if ($err) {
			return $err;
		} else {
			return $result;
		}
	}

	private function filterResponse($json, $assoc = true) {
		$json = preg_replace('/,\s*([\]}])/m', '$1', $json);
		return json_decode($json, $assoc);
	}
}
