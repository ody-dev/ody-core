<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Normalizeable
{
    /**
     * Replace, reorder and use numeric keys on a collection.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#normalize
     *
     * @return Collection<int, T>
     */
    public function normalize(): Collection;
}
