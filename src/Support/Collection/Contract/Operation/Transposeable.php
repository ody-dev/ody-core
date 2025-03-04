<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Transposeable
{
    /**
     * Computes the transpose of a matrix.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#transpose
     *
     * @return Collection<TKey, list<T>>
     */
    public function transpose(): Collection;
}
