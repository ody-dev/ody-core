<?php

declare(strict_types=1);
namespace Ody\Core\Contracts;

use Swoole\Coroutine\Http\Server as CoHttpServer;
use Swoole\Coroutine\Server as CoServer;
use Swoole\Server;

interface ProcessInterface
{
    /**
     * Create the process object according to process number and bind to server.
     * @param CoHttpServer|CoServer|Server $server
     */
    public function bind($server): void;

    /**
     * Determine if the process should start ?
     * @param CoServer|Server $server
     */
    public function isEnable($server): bool;

    /**
     * The logical of process will place in here.
     */
    public function handle(): void;
}
