<?php

declare(strict_types=1);
namespace Ody\Core\Contract;

interface FrequencyInterface
{
    /**
     * Number of hit per time.
     */
    public function hit(int $number = 1): bool;

    /**
     * Hits per second.
     */
    public function frequency(): float;
}
