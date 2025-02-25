<?php

namespace Ody\Core\Server;

use Ody\Core\Console\Style;
use Ody\Core\Kernel;
use Swoole\Http\Server;

class Http
{
    private Server $server;

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
     * @return void
     * @throws \Exception
     */
    public function init($daemonize = false): void
    {
        match($this->phpServer) {
            // Start a Swoole webserver
            0 => (new \Ody\Swoole\Http())
                ->createServer(
                    Kernel::init(),
                    $this->host,
                    $this->port
                )->start($daemonize),
            // Start as a normal PHP webserver
            1 => exec("php -S {$this->host}:{$this->port} " . __DIR__ . '/init_php_server.php'),
            default => throw new \Exception('Unexpected match value')
        };
    }
}
