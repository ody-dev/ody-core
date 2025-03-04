<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Closure;
use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Sortable
{
    public const BY_KEYS = 1;

    public const BY_VALUES = 0;

    /**
     * Sort a collection using a callback. If no callback is provided, it will sort using natural order.
     * By default, it will sort by values and using a callback.
     * If you want to sort by keys, you can pass a parameter to change the behaviour or use twice the `flip` operation.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#sort
     *
     * @param null|callable|Closure(T, T, TKey, TKey): int $callback
     *
     * @return Collection<TKey, T>
     */
    public function sort(int $type = Sortable::BY_VALUES, null|callable|Closure $callback = null): Collection;
}
