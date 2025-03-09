<?php

namespace Ody\Core\Foundation\Providers;

use Composer\InstalledVersions;
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
        $providers[] =\Ody\Core\Foundation\Providers\ConsoleServiceProvider::class;
        if (InstalledVersions::isInstalled('ody/scheduler')) {
            $providers[] = \Ody\Scheduler\Providers\SchedulerServiceProvider::class;
        }

        if (InstalledVersions::isInstalled('ody/websocket')) {
            $providers[] = \Ody\Websocket\Providers\WebsocketServiceProvider::class;
        }

        if (InstalledVersions::isInstalled('ody/database')) {
            $providers[] = \Ody\DB\ServiceProviders\DatabaseServiceProvider::class;
        }

        if (InstalledVersions::isInstalled('ody/server')) {
            $providers[] = \Ody\Server\Providers\HttpServerServiceProvider::class;
        }

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