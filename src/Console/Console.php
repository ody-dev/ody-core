<?php
declare (strict_types = 1);
namespace Ody\Core\Console;

use Composer\ClassMapGenerator\ClassMapGenerator;
use Ody\Core\Env;
use Symfony\Component\Console\Application;
use Exception;

final class Console
{
    /**
     * @throws Exception
     */
    public static function init(): void
    {
        Env::load('./');
        $application = new Application();
        $application->addCommands(
            (new Console())->generateCommandsClassMap()
        );
        $application->run();
    }

    private function generateCommandsClassMap(): array
    {
        $classMapGenerator = new ClassMapGenerator;
        $classMapGenerator->scanPaths('App/Console/Commands');
        $classMapGenerator->scanPaths(__dir__ . '/Commands');
        $classMapGenerator = $classMapGenerator->getClassMap();

        $classMap = [];
        foreach (array_keys($classMapGenerator->getMap()) as $class) {
            $classMap[] = new $class();
        }

        if (class_exists('Ody\DB\Migrations\Command\StatusCommand')) {
            $classMap[] = new \Ody\DB\Migrations\Command\StatusCommand('migrations:status');
            $classMap[] = new \Ody\DB\Migrations\Command\MigrateCommand('migrations:run');
            $classMap[] = new \Ody\DB\Migrations\Command\CleanupCommand('migrations:clear');
            $classMap[] = new \Ody\DB\Migrations\Command\DumpCommand('migrations:dump');
            $classMap[] = new \Ody\DB\Migrations\Command\InitCommand('migrations:init');
            $classMap[] = new \Ody\DB\Migrations\Command\RollbackCommand('migrations:rollback');
            $classMap[] = new \Ody\DB\Migrations\Command\StatusCommand('migrations:status');
            $classMap[] = new \Ody\DB\Migrations\Command\CreateCommand('migrations:create');
            $classMap[] = new \Ody\DB\Migrations\Command\DiffCommand('migrations:diff');
        }


        return $classMap;
    }
}