<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\Repositories\Contract\TravelReportInterface', 'App\Repositories\Eloquent\TravelReportRepository');
        $this->app->singleton('App\Repositories\Contract\TripReportInterface', 'App\Repositories\Eloquent\TripReportRepository');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
