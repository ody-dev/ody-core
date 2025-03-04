<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Applyable
{
    /**
     * Execute callback(s) on each element of the collection.
     * Iterates on the collection items regardless of the return value of the callback.
     * If the callback does not return `true` then it stops applying callbacks on subsequent items.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#apply
     *
     * @param callable(T, TKey, iterable<TKey, T>): bool ...$callbacks
     *
     * @return Collection<TKey, T>
     */
    public function apply(callable ...$callbacks): Collection;
}
