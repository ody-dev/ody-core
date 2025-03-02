<?php

namespace Ody\Core\Foundation\Loaders;

use Ody\Core\Foundation\Providers\ServiceProvider;

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