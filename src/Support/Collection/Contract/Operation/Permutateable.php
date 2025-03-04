<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Permutateable
{
    /**
     * Find all the permutations of a collection.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#permutate
     *
     * @return Collection<TKey, T>
     */
    public function permutate(): Collection;
}
