<?php

declare(strict_types=1);
namespace Ody\Core\Contracts;

interface DispatcherInterface
{
    public function dispatch(...$params);
}
