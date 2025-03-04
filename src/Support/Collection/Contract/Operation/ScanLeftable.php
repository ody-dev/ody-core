<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface ScanLeftable
{
    /**
     * Takes the initial value and the first item of the list and applies the function to them,
     * then feeds the function with this result and the second argument and so on.
     * It returns the list of intermediate and final results.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#scanleft
     *
     * @template V
     *
     * @param callable(V, T, TKey, iterable<TKey, T>): V $callback
     * @param V $initial
     *
     * @return Collection<TKey|int, V>
     */
    public function scanLeft(callable $callback, mixed $initial): Collection;
}
