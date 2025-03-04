<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Collection;
use Ody\Core\Support\Collection\Contract\Collection as CollectionInterface;

/**
 * @template TKey
 * @template T
 */
interface Spanable
{
    /**
     * Partition the collection into two subgroups where the first element is the longest prefix (possibly empty)
     * of elements that satisfy the callback(s) and the second element is the remainder.
     *
     * The first inner collection is the result of a `TakeWhile` operation.
     * The second (and last) inner collection is the result of a `DropWhile` operation.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#span
     *
     * @param callable(T, TKey, iterable<TKey, T>): bool ...$callbacks
     *
     * @return CollectionInterface<int, Collection<TKey, T>>
     */
    public function span(callable ...$callbacks): CollectionInterface;
}
