<?php

namespace Ody\Core\Foundation\Providers;

use Ody\Core\Foundation\App;

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
        array_walk($providers, fn ($provider) => $provider->register());
        array_walk($providers, fn ($provider) => $provider->boot());

        if ($app->runningInConsole()) {
            $commands = [];
            foreach ($providers as $provider) {
                $commands = array_merge($provider->commands, $commands);
            }

            $app->getContainer()->set('consoleCommands', $commands);
        }
    }
}