<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Models\{DeviceMaster, Role};
use Carbon\Carbon;
use Auth;
use Session;
use ApiCall;
use App\Repositories\Contract\TripReportInterface;
use App\Repositories\Contract\TravelReportInterface;

class ReportController extends Controller
{
    public function trip(TripReportInterface $apiCall, Request $request, Client $client){
        $responseData = $apiCall->current($request, $client);
        return view('pages.reports.trip')->with([
            'data' => $responseData,
            'inputs' => $request->all()
        ]);
    }

    // TRAVEL REPORT

    public function travel(TravelReportInterface $apiCall, Request $request, Client $client){
        $responseData = $apiCall->current($request, $client);
        return view('pages.reports.travel')->with([
            'data' => $responseData,
            'inputs' => $request->all()
        ]);
    }

    public function travelModify(TravelReportInterface $apiCall, Request $request, Client $client){
        $responseData = $apiCall->withFilters($request, $client);
        return view('pages.reports.travel')->with([
            'data' => $responseData,
            'endDate' => date('m/d/Y', strtotime($dateTo)),
            'startDate' => date('m/d/Y', strtotime($dateFrom))
        ]);
    }


    /**
     * \\********** Functional Logics ****************\\
     */



    // GET LOCATION FROM LONG LAT

    private function getLocation($long, $lat) {
        $client = new Client();
        $to_location = "$long,$lat";
        $apiRequest = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json?&key=AIzaSyDFqrV7p6S7j-eORKH7RHeOTEwFSZeuImc&latlng=' . trim($to_location) . '&sensor=false');
        if ($apiRequest->getStatusCode() === 200) {
            $data = json_decode($apiRequest->getBody()->getContents())->results[0];
            return $data->formatted_address;
        } else {
            return 'Some error occured in making request to google server!';
        }
    }

    private function getTimeFromTimestamps($requestData) {
        $data = $requestData->values();
        return $this->getTimeFromDates($data);
    }

    private function getTimeFromDates($data) {
        $hours = 0;
        $minutes = 0;
        $seconds = 0;
        foreach ($data as $index => $item) {
            if ($data->count() > ($index + 1) && Carbon::parse($item->PacketDateTime)->addHours(5)->addMinutes(30)->format('Y-m-d') == date('Y-m-d', strtotime('0 day'))) {
                $from_date = Carbon::parse($item->PacketDateTime);
                $to_date = Carbon::parse($data[$index + 1]->PacketDateTime);
                $date = $to_date->diffInSeconds($from_date);
                $dateDifference = gmdate("H:i", $date);
                $hours += (int) gmdate('H', strtotime($dateDifference));
                $minutes += (int) gmdate('i', strtotime($dateDifference));
                $seconds += (int) gmdate('s', strtotime($dateDifference));
                if ($seconds >= 60) {
                    $newSeconds = $seconds % 60;
                    $minutes += (int) ($seconds / 60);
                    $seconds = $newSeconds;
                }
                if ($minutes >= 60) {
                    $newMinutes = $minutes % 60;
                    $hours += (int) ($minutes / 60);
                    $minutes = $newMinutes;
                }
            }
        }
        $time = (strlen($hours) == 1 ? '0' . $hours : $hours) . ':' . (strlen($minutes) == 1 ? '0' . $minutes : $minutes);
        if ($data->count() > 0) {
            return $time;
        } else {
            return "00:00";
        }

    }

}
