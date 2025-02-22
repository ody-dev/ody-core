<?php

namespace Ody\Core\Console;

use Ody\Core\Console\Commands\Migrations\CreateMigrationCommand;
use Ody\Core\Console\Commands\Migrations\MigrateCommand;
use Ody\Core\Console\Commands\Migrations\RollbackMigrationsCommand;
use Ody\Core\Console\Commands\ServeCommand;
use Ody\Core\Console\Commands\ShellCommand;
use Symfony\Component\Console\Application;

final class Console
{
    /**
     * @throws \Exception
     */
    public static function init(): void
    {
        $application = new Application();
        $application->addCommands(self::commands());
        $application->run();
    }

    private static function commands(): array
    {
        return [
            new ServeCommand(),
            new MigrateCommand(),
            new RollbackMigrationsCommand(),
            new CreateMigrationCommand(),
            new ShellCommand(),
        ];
    }
}