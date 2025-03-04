<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Productable
{
    /**
     * Get the the cartesian product of items of a collection.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#product
     *
     * @template UKey
     * @template U
     *
     * @param iterable<UKey, U> ...$iterables
     *
     * @return Collection<TKey, list<T|U>>
     */
    public function product(iterable ...$iterables): Collection;
}
