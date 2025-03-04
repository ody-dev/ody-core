<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Wrapable
{
    /**
     * Wrap every element into an array.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#wrap
     *
     * @return Collection<int, array<TKey, T>>
     */
    public function wrap(): Collection;
}
