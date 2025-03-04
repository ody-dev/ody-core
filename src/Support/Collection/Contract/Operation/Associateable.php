<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Associateable
{
    /**
     * Transform keys and values of the collection independently and combine them.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#associate
     *
     * @template UKey
     * @template U
     *
     * @param callable(TKey, T, iterable<TKey, T>): UKey $callbackForKeys
     * @param callable(T, TKey, iterable<TKey, T>): U $callbackForValues
     *
     * @return Collection<UKey, U>
     */
    public function associate(?callable $callbackForKeys = null, ?callable $callbackForValues = null): Collection;
}
