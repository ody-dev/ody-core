<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

/**
 * @template TKey
 * @template T
 */
interface Comparable
{
    /**
     * Fold the collection through a comparison operation, yielding the "highest" or "lowest"
     * element as defined by the comparator callback. The callback takes a pair of two elements
     * and should return the "highest" or "lowest" one as desired.
     *
     * If no custom logic is required for the comparison, the simpler `max` or `min` operations
     * can be used instead.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#compare
     *
     * @template V
     *
     * @param callable(T, T, TKey, iterable<TKey, T>): T $comparator
     * @param V $default
     *
     * @return T|V
     */
    public function compare(callable $comparator, mixed $default = null);
}
