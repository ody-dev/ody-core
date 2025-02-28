<?php

declare(strict_types=1);
namespace Ody\Core\Contract;

interface DispatcherInterface
{
    public function dispatch(...$params);
}
