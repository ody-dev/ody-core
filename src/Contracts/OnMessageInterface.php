<?php

declare(strict_types=1);
namespace Ody\Core\Contracts;

use Swoole\Http\Response;
use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server;

interface OnMessageInterface
{
    /**
     * @param Response|Server $server
     * @param Frame $frame
     */
    public function onMessage($server, $frame): void;
}
