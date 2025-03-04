<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Intersectkeysable
{
    /**
     * Removes any keys from the original collection that are not present in the given keys set.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#intersectkeys
     *
     * @return Collection<TKey, T>
     */
    public function intersectKeys(mixed ...$keys): Collection;
}
