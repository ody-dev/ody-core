<?php

declare(strict_types=1);
namespace Ody\Core\Contracts;

interface MiddlewareInitializerInterface
{
    public function initCoreMiddleware(string $serverName): void;
}
