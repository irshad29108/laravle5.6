<?php
namespace App\Repositories\Eloquent;

use App\Models\DeviceMaster;
use App\Models\Role;
use App\Repositories\Contract\TravelReportInterface as TravelContract;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Auth;
use GuzzleHttp\Exception\ClientException;

class TravelReportRepository implements TravelContract
{
    private $travelURI = 'http://localhost:3000/api/report-current';
    private $travelFilteredURI = 'http://localhost:3000/api/report';
    /**
     * TRIP REPORT CURRENT
     */
    public function current($request, $client) {
        $response = new Collection;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $per_page = 25;
        $requestParams = [
            'connect_timeout' => 10
        ];
        try {
            $httpResponse = $client->request('POST', $this->travelURI, $requestParams);
            if ($httpResponse->getStatusCode() === 200) {
                $data = collect(json_decode($httpResponse->getBody()->getContents())->response->data);
            }
        } catch (ClientException $exception) {
            $responseBody = $exception->getResponse()->getBody(true);
            $data = null;
        }
        if ($data) {
            $devicesCount = $devices = DeviceMaster::whereIn('imei', $data->pluck('IMEI')->toArray())
            ->whereHas('object', function($query) use($data) {
                if (Auth::user()->master->type->id == Role::SUPER_ADMIN) {
                    return $query;
                } else {
                    return $query->where('company_id', Auth::user()->master->id);
                }
            })->count();
            $devices = DeviceMaster::whereIn('imei', $data->pluck('IMEI')->toArray())->whereHas('object', function($query) {
                if (Auth::user()->master->type->id == Role::SUPER_ADMIN) {
                    return $query;
                } else {
                    return $query->where('company_id', Auth::user()->master->id);
                }
            })->with('object.company', 'object.branch')->get();
            if ($data->count()) {
                $response = $this->getTravelReport($devices->slice(($currentPage-1) * $per_page, $per_page), $data);
            } elseif ($httpResponse->getStatusCode() === 500) {
                $response = [];
            }
            $responseData = new LengthAwarePaginator($response, $devicesCount, $per_page);
            $responseData->setPath($request->url());
        }
        return $responseData;
    }

    /**
     * TRIP REPORT CURRENT
     */
    public function withFilters($request, $client) {
        $response = new Collection;
        //Get current page form url e.g. &page=6
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        //Define how many items we want to be visible in each page
        $per_page = 25;
        $devicesCount = $devices = DeviceMaster::whereHas('object', function($query) {
            if (Auth::user()->master->type->id == Role::SUPER_ADMIN) {
                return $query;
            } else {
                return $query->where('company_id', Auth::user()->master->id);
            }
        })->count();
        $dateFrom = date("Ymd", strtotime($request->from_date));
        $dateTo = date("Ymd", strtotime($request->to_date));
        $requestParams = [];
        if ($dateFrom != $dateTo) {
            $requestParams = [
            'form_params' => [
                'date' => $dateFrom,
                'endDate' => $dateTo,
                ]
            ];
        } else {
            $dateFrom = (string) ($dateFrom - 1);
            $requestParams = [
            'form_params' => [
                    'date' => $dateFrom,
                    'endDate' => $dateTo,
                ]
            ];
        }
        $devices = DeviceMaster::whereHas('object', function($query) {
            if (Auth::user()->master->type->id == Role::SUPER_ADMIN) {
                return $query;
            } else {
                return $query->where('company_id', Auth::user()->master->id);
            }
        })->with('object.company', 'object.branch')->get()->slice(($currentPage-1) * $per_page, $per_page);

        $httpResponse = $client->request('POST', $this->travelFilteredURI, $requestParams);
        if ($httpResponse->getStatusCode() == 200) {
            $data = collect(json_decode($httpResponse->getBody()->getContents())->userData);
            $response = $this->getTravelReport($devices, $data);
        }

        //Create our paginator and add it to the data array
        $responseData = new LengthAwarePaginator($response, $devicesCount, $per_page);

        //Set base url for pagination links to follow e.g custom/url?page=6
        $responseData->setPath($request->url());
    }

    // GET TRAVEL REPORT
    private function getTravelReport($devices, $data) {
        $response = new Collection;
        foreach ($devices->chunk(10) as $deviceChunk) {
            foreach ($deviceChunk as $device) {
                $vehicleResponse = new Collection;
                if ($data != null && $data->where('IMEI', $device->imei)->count() > 0) {
                    $vehicleInstances = $data->where('IMEI', $device->imei)->first();
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
                    $vehicleResponse->tripCount = $vehicleInstances->tripCount;
                }
                $response->push($vehicleResponse);
            }
        }
        return $response;
    }
}
