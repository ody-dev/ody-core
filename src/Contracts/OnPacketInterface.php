<?php

declare(strict_types=1);
namespace Ody\Core\Contracts;

use Swoole\WebSocket\Server;

interface OnPacketInterface
{
    /**
     * @param Server $server
     * @param mixed $data
     * @param array $clientInfo
     */
    public function onPacket($server, $data, $clientInfo): void;
}
