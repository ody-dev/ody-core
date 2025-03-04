<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Collection;
use Ody\Core\Support\Collection\Contract\Collection as CollectionInterface;

/**
 * @template TKey
 * @template T
 */
interface Partitionable
{
    /**
     * Partition the collection into two subgroups of items using one or more callables.
     *
     * The first inner collection contains items that have met the provided callback(s).
     * The second (and last) collection contains items that have not met the provided callback(s).
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#partition
     *
     * @param callable(T, TKey, iterable<TKey, T>): bool ...$callbacks
     *
     * @return CollectionInterface<int, Collection<TKey, T>>
     */
    public function partition(callable ...$callbacks): CollectionInterface;
}
