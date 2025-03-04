<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Mergeable
{
    /**
     * Merge one or more iterables onto a collection.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#merge
     *
     * @template U
     *
     * @param iterable<U> ...$sources
     *
     * @return Collection<TKey, T|U>
     */
    public function merge(iterable ...$sources): Collection;
}
