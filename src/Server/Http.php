<?php

namespace Ody\Core\Server;

use Composer\InstalledVersions;
use Ody\Core\App;
use Ody\Core\Console\Style;
use Ody\Core\Env;
use Ody\Core\Exception\PackageNotFoundException;
use Ody\Core\Facades\Facade;
use Ody\Swoole\ServerRequestFactory;
use Swoole\Http\Server;

class Http
{
    private Server $server;


    public function __construct(
        private readonly int $phpServer,
        private Style        $io,
    ) {}

    /**
     * Starts a Swoole HTTP server
     *
     * @return void
     */
    public function start(): void
    {
        if ($this->phpServer) {
            $host = config('server.host');
            $port = config('server.port');
            exec("php -S {$host}:{$port} " . __DIR__ . '/init_php_server.php');
        }

        if (!$this->phpServer) {
            $this->server->start();
        }
    }

    /**
     * @throws PackageNotFoundException
     */
    public function createServer(): static
    {
        if (!$this->phpServer) {
            $this->checkRequiredDependencies();
            $this->createSwooleServer();
        }

        return $this;
    }

    public function createSwooleServer(): void
    {
        $this->server = new Server(
            config('server.host') ,
            config('server.port') ,
            !is_null(config('server.ssl.ssl_cert_file')) && !is_null(config('server.ssl.ssl_key_file')) ? config('server.mode') | SWOOLE_SSL : config('server.mode') ,
            config('server.sockType')
        );

        $this->server->on('request', ServerRequestFactory::createRequestCallback($this->initApp()));
        $this->server->on('workerStart', [$this, 'onWorkerStart']);
        $this->server->set(array_merge(config('server.additional') , ['enable_coroutine' => false]));
    }

    public static function initApp(): App
    {
        Env::load(basePath());
        $app = \Ody\Core\DI\Bridge::create();
        $app->addBodyParsingMiddleware();
        $app->addRoutingMiddleware();
        $app->addErrorMiddleware((bool) $_ENV['APP_DEBUG'], (bool) $_ENV['APP_DEBUG'], (bool) $_ENV['APP_DEBUG']);
        Facade::setFacadeApplication($app);

        /**
         * Register routes
         */
        require basePath('App/routes.php');

        /**
         * Register DB
         */
        if (class_exists('Ody\DB\Eloquent')) {
            \Ody\DB\Eloquent::boot(config('database.environments')[$_ENV['APP_ENV']]);
        }

        return $app;
    }

    public function onWorkerStart(Server $server, int $workerId): void
    {
        if ($workerId == config('server.additional.worker_num') - 1){
            $this->saveWorkerIds($server);
        }
    }

    protected function saveWorkerIds(Server $server): void
    {
        $workerIds = [];
        for ($i = 0; $i < config('server.additional.worker_num'); $i++){
            $workerIds[$i] = $server->getWorkerPid($i);
        }

        setMasterProcessId($server->getMasterPid());
        setManagerProcessId($server->getManagerPid());
        setWorkerProcessIds($workerIds);
    }

    private function checkRequiredDependencies(): void
    {
        if (!InstalledVersions::isInstalled('ody/swoole')) {
            $this->io->error('Missing dependencies. Please run `composer require ody/swoole` to install the missing dependencies!.' , true);
            throw new PackageNotFoundException('Missing dependencies. Please run `composer require ody/swoole` to install the missing dependencies!.');
        }

        if (!extension_loaded('swoole')){
            $this->io->error("The php-swoole extension is not installed! Please run `apt install php8.3-swoole`." , true);
            throw new \Exception('The php-swoole extension is not installed.');
        }
    }

}