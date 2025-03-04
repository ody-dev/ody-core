<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Whenable
{
    /**
     * This operation will execute the given `$whenTrue` callback when the given `$predicate` callback
     * evaluates to `true`. Otherwise it will execute the `$whenFalse` callback if any.
     *
     * Unlike the `ifThenElse` operation where the operation is applied to each element of the collection,
     * this operation operates on the collection directly.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#when
     *
     * @param callable(iterable<TKey, T>): bool $predicate
     * @param callable(iterable<TKey, T>): iterable<TKey, T> $whenTrue
     * @param callable(iterable<TKey, T>): iterable<TKey, T> $whenFalse
     *
     * @return Collection<TKey, T>
     */
    public function when(callable $predicate, callable $whenTrue, ?callable $whenFalse = null): Collection;
}
