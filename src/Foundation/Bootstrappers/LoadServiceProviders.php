<?php

namespace Ody\Core\Foundation\Bootstrappers;

use Ody\Core\ServiceProviders\RouteServiceProvider;
use Ody\Core\ServiceProviders\ServiceProvider;

class LoadServiceProviders extends Bootstrapper
{
    public function boot()
    {
        $app = $this->app;
        $providers = config('app.providers');

//        $providers = [...$providers, RouteServiceProvider::class];

//        if ($app->bootedViaHttpRequest()) {
//            $providers = [...$providers, RouteServiceProvider::class];
//        } else if ($app->bootedViaConsole()) {
////            $providers = [...$providers, \App\Providers\ConsoleServiceProvider::class];
//        }

        ServiceProvider::setup($app, $providers);
    }
}