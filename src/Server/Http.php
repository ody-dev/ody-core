<?php

namespace Ody\Core\Server;

use Ody\Core\App;
use Ody\Core\Console\Style;
use Ody\Core\Env;
use Ody\Core\Facades\Facade;
use Ody\Swoole\ServerRequestFactory;
use Swoole\Http\Server;

class Http
{
    private Server $server;

    private string $host;

    private int $port;

    public function __construct(
        private readonly int $phpServer,
        private Style        $io,
    ) {
        $this->host = config('server.host');
        $this->port = config('server.port');
    }

    /**
     * Starts the server
     *
     * @return void
     */
    public function start(): void
    {
        if ($this->phpServer) {
            exec("php -S {$this->host}:{$this->port} " . __DIR__ . '/init_php_server.php');
        }

        if (!$this->phpServer) {
            $this->server->start();
        }
    }

    /**
     * @return Http
     */
    public function createServer(): static
    {
        if (!$this->phpServer) {
            Dependencies::check($this->io);
            $this->createSwooleServer();
        }

        return $this;
    }

    /**
     * Creates a Swoole HTTP server instance
     *
     * @return void
     */
    public function createSwooleServer(): void
    {
        $this->server = new Server(
            $this->host,
            $this->port,
            !is_null(config('server.ssl.ssl_cert_file')) && !is_null(config('server.ssl.ssl_key_file')) ? config('server.mode') | SWOOLE_SSL : config('server.mode') ,
            config('server.sockType')
        );

        $this->server->on('request', ServerRequestFactory::createRequestCallback($this->initApp()));
        $this->server->on('workerStart', [$this, 'onWorkerStart']);
        $this->server->set(array_merge(config('server.additional') , ['enable_coroutine' => false]));
    }

    /**
     * Initialises the application
     *
     * @return App $app
     */
    public static function initApp(): App
    {
        Env::load(base_path());
        $app = \Ody\Core\DI\Bridge::create();
        $app->addBodyParsingMiddleware();
        $app->addRoutingMiddleware();
        $app->addErrorMiddleware((bool) $_ENV['APP_DEBUG'], (bool) $_ENV['APP_DEBUG'], (bool) $_ENV['APP_DEBUG']);
        Facade::setFacadeApplication($app);

        /**
         * Register routes
         */
        require base_path('App/routes.php');

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

        $serveState = ServerState::getInstance();
        $serveState->setMasterProcessId($server->getMasterPid());
        $serveState->setManagerProcessId($server->getManagerPid());
        $serveState->setWorkerProcessIds($workerIds);
    }
}
