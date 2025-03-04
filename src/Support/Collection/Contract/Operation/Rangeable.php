<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

use const INF;

interface Rangeable
{
    /**
     * Build a collection from a range of values.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#range
     *
     * @return Collection<int, float>
     */
    public static function range(float $start = 0.0, float $end = INF, float $step = 1.0): Collection;
}
