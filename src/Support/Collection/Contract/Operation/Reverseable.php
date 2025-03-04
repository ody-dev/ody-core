<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Reverseable
{
    /**
     * Reverse the order of items in a collection.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#reverse
     *
     * @return Collection<TKey, T>
     */
    public function reverse(): Collection;
}
