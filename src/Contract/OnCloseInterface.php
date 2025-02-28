<?php

declare(strict_types=1);
namespace Ody\Core\Contract;

use Swoole\Http\Response;
use Swoole\Server;

interface OnCloseInterface
{
    /**
     * @param Response|Server $server
     */
    public function onClose($server, int $fd, int $reactorId): void;
}
