<?php

namespace Ody\Core\Foundation\Providers;

use Ody\Core\Foundation\Console\Commands\ShellCommand;
use Ody\Core\Foundation\Console\Commands\StatusCommand;

class ConsoleServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands = [
                ShellCommand::class,
                StatusCommand::class,
            ];
        }
    }
}