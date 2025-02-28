<?php

namespace Ody\Core\Server;

use Exception;
use Ody\Core\App;

class Http
{
    private string $host;

    private int $port;

    public function __construct(
        private readonly int $phpServer
    ) {
        $this->host = config('server.host');
        $this->port = config('server.port');
    }

    /**
     * Starts the server
     *
     * @param bool $daemonize
     * @return void
     * @throws Exception
     */
    public function init(bool $daemonize = false): void
    {
        match($this->phpServer) {
            // Start a Swoole webserver
            0 => (new \Ody\HttpServer\Server())
                ->createServer(
                    App::init(),
                    $daemonize
                )->start(),
            // Start as a normal PHP webserver
            1 => exec("php -S {$this->host}:{$this->port} " . __DIR__ . '/init_php_server.php'),
            default => throw new Exception('Unexpected match value')
        };
    }
}
