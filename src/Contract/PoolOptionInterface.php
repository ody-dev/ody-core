<?php

declare(strict_types=1);
namespace Ody\Core\Contract;

interface PoolOptionInterface
{
    public function getMaxConnections(): int;

    public function getMinConnections(): int;

    public function getConnectTimeout(): float;

    public function getWaitTimeout(): float;

    public function getHeartbeat(): float;

    public function getMaxIdleTime(): float;

    public function getEvents(): array;
}
