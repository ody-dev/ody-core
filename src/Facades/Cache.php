<?php

namespace Ody\Core\Facades;

use Ody\Core\Kernel;

final class Cache extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return '\Ody\Swoole\Cache\Cache';
    }
}