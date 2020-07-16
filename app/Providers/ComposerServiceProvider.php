<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $params = ['pages.account.*'];
        View::composer($params, 'App\Http\View\Composers\SidePanel');
    }
}
