<?php

namespace Ody\Core\ServiceProviders;

use Ody\Core\App;

abstract class ServiceProvider
{
    public App $app;

    final public function __construct(App &$app)
    {
        $this->app = $app;
    }

    abstract public function register();

    abstract public function boot();

    final public static function setup(App &$app, array $providers)
    {
        $providers = array_map(fn ($provider) => new $provider($app), $providers);

        foreach ($providers as $provider) {
            $provider->register();
        }

        foreach ($providers as $provider) {
            $provider->boot();
        }

//        array_walk($providers, fn ($provider) => new $provider->register());
//        array_walk($providers, fn ($provider) => new $provider->boot());
    }
}