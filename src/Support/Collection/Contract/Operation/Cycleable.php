<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Cycleable
{
    /**
     * Cycle indefinitely around a collection of items.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#cycle
     *
     * @return Collection<TKey, T>
     */
    public function cycle(): Collection;
}
