<?php

declare(strict_types=1);
namespace Ody\Core\Contracts;

interface Synchronized
{
    /**
     * Whether the data has been synchronized.
     */
    public function isSynchronized(): bool;
}
