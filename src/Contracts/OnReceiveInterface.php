<?php

declare(strict_types=1);
namespace Ody\Core\Contracts;

use Hyperf\Server\Connection as HyperfConnection;
use Swoole\Coroutine\Server\Connection;
use Swoole\Server as SwooleServer;
use Swow\Socket;

interface OnReceiveInterface
{
    /**
     * @param Connection|HyperfConnection|Socket|SwooleServer $server
     */
    public function onReceive($server, int $fd, int $reactorId, string $data): void;
}
