<?php

namespace Ody\Core\Foundation\Providers;

use Ody\Core\Support\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function register()
    {
        Route::setup($this->app);
    }

    public function boot()
    {
        require routes_path('api.php');
    }
}