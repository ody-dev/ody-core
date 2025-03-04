<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Initsable
{
    /**
     * Returns all initial segments of the collection, shortest first.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#inits
     *
     * @return Collection<int, list<array{0: TKey, 1: T}>>
     */
    public function inits(): Collection;
}
