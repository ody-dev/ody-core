<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Mapable
{
    /**
     * Apply a single callback to every item of a collection and use the return value.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#map
     *
     * @template U
     *
     * @param callable(T, TKey, iterable<TKey, T>): U $callback
     *
     * @return Collection<TKey, U>
     */
    public function map(callable $callback): Collection;
}
