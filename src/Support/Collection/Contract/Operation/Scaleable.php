<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Scaleable
{
    /**
     * Scale/normalize values.Scale/normalize values.
     * Values will be scaled between  `0` and `1` by default, if no desired bounds are provided.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#scale
     *
     * @return Collection<TKey, float|int>
     */
    public function scale(
        float $lowerBound,
        float $upperBound,
        float $wantedLowerBound = 0.0,
        float $wantedUpperBound = 1.0,
        float $base = 0.0
    ): Collection;
}
