<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Strictable
{
    /**
     * Enforce a single type in the collection at runtime.
     * If the collection contains objects, they will either be expected to implement the same interfaces
     * or be of the exact same class (no inheritance logic applies).
     *
     * Note that the current logic allows *arrays* of any type in the collection, as well as *null*.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#strict
     *
     * @param null|callable(mixed): string $callback
     *
     * @return Collection<TKey, T>
     */
    public function strict(?callable $callback = null): Collection;
}
