<?php

namespace Ody\Core\Foundation\Providers;

use Ody\Core\Foundation\App;
use Ody\HttpServer\ServiceProviders\HttpServerServiceProvider;

abstract class ServiceProvider
{
    public App $app;

    public array $commands = [];

    final public function __construct(App &$app)
    {
        $this->app = $app;
    }

    abstract public function register();

    abstract public function boot();

    final public static function setup(App &$app, array $providers)
    {
        $providers = array_map(fn ($provider) => new $provider($app), $providers);

//        foreach ($providers as $provider) {
//            $provider->register();
//        }
//
//        foreach ($providers as $provider) {
//            $provider->boot();
//        }

//        dd($provider->commands);


        array_walk($providers, fn ($provider) => $provider->register());
        array_walk($providers, fn ($provider) => $provider->boot());

        $commands = [];
        foreach ($providers as $provider) {
            $commands = array_merge($provider->commands, $commands);
        }

        $app->getContainer()->set('consoleCommands', $commands);
    }
}