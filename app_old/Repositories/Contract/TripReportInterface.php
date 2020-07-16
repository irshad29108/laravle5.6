<?php
namespace App\Repositories\Contract;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

interface TripReportInterface {
    /**
     * TRIP REPORT
     */
    public function current($request, $client);
    /**
     * TRIP REPORT
     * WITH FILTERS
     */
    public function withFilters($request, $client);
}
