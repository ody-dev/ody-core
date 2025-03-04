<?php
declare (strict_types = 1);
namespace Ody\Core\Foundation\Console;

use Composer\ClassMapGenerator\ClassMapGenerator;
use Exception;
use Ody\Core\Foundation\App;
use Symfony\Component\Console\Application;

final class Console
{
    /**
     * @throws Exception
     */
    public static function init($app): void
    {
        $application = new Application();
        $application->addCommands(
            (new Console())->generateCommandsClassMap($app)
        );
        $application->run();
    }

    private function generateCommandsClassMap(App $app): array
    {
        $classMapGenerator = new ClassMapGenerator;
        $classMapGenerator->scanPaths(__dir__ . '/Commands');
        $classMapGenerator = $classMapGenerator->getClassMap();

        $classMap = [];
        foreach (array_keys($classMapGenerator->getMap()) as $class) {
            $classMap[] = new $class();
        }

        foreach ($app->resolve('consoleCommands') as $command) {
            $classMap[] = new $command();
        }

        return $classMap;
    }
}