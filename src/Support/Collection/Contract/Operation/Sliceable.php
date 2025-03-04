<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Sliceable
{
    /**
     * Get a slice of a collection.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#slice
     *
     * @return Collection<TKey, T>
     */
    public function slice(int $offset, int $length = -1): Collection;
}
