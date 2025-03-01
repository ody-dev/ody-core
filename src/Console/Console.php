<?php
declare (strict_types = 1);
namespace Ody\Core\Console;

use Composer\ClassMapGenerator\ClassMapGenerator;
use Ody\Core\Env;
use Ody\Core\Foundation\App;
use Ody\HttpServer\ServiceProviders\HttpServerServiceProvider;
use Symfony\Component\Console\Application;
use Exception;

final class Console
{
    /**
     * @throws Exception
     */
    public static function init($app): void
    {
        Env::load('./');
        $application = new Application();
        $application->addCommands(
            (new Console())->generateCommandsClassMap($app)
        );
        $application->run();
    }

    private function generateCommandsClassMap(App $app): array
    {
        $classMapGenerator = new ClassMapGenerator;
        $classMapGenerator->scanPaths('App/Console/Commands');
        $classMapGenerator->scanPaths(__dir__ . '/Commands');
        $classMapGenerator = $classMapGenerator->getClassMap();

        $classMap = [];
        foreach (array_keys($classMapGenerator->getMap()) as $class) {
            $classMap[] = new $class();
        }

        foreach ($app->getContainer()->get('consoleCommands') as $command) {
            $classMap[] = new $command();
        }

        return $classMap;
    }
}