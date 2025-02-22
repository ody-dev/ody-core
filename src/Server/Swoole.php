<?php

namespace Ody\Core\Server;

use Ody\Core\App;
use Ody\Core\Exception\PackageNotFoundException;
use Ody\Swoole\FileWatchers\InotifyWatcher;
use Ody\Swoole\HotCodeReloader;
use Ody\Swoole\ServerRequestFactory;
use Swoole\Http\Server;

class Swoole
{
    /**
     * Starts a Swoole HTTP server
     *
     * @param App $app
     * @return void
     * @throws PackageNotFoundException
     */
    public static function start(App $app): void
    {
        if (!\Composer\InstalledVersions::isInstalled('ody/swoole')) {
            throw new PackageNotFoundException('Missing dependencies. Please run `composer require ody/swoole` to install the missing dependencies!.');
        }

        $server = new Server('localhost', 9501);
        $server->on('start', function ($server) {
            echo "Server started on http://" . $server->host . ":" . $server->port . PHP_EOL;
            $watcher = new InotifyWatcher();
            $watcher->addFilePath('/home/ilyas/script/ody/App');

            // Reloader tracks the changes every 1000 ms.
            $reloader = new HotCodeReloader($watcher, $server, 1000);
            $reloader->start();
        });

        $server->on('request', ServerRequestFactory::createRequestCallback($app));
        $server->set([
            "reactor_num" => 2,
            "worker_num" => 2,
        ]);
        $server->start();
    }
}