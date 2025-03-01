<?php

declare(strict_types=1);
namespace Ody\Core\Contracts;

use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\WebSocket\Server;
use Swow\Psr7\Server\ServerConnection;

interface OnOpenInterface
{
    /**
     * @param Response|Server|ServerConnection $server
     * @param Request $request
     */
    public function onOpen($server, $request): void;
}
