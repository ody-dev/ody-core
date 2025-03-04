<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Tailsable
{
    /**
     * Returns the list of initial segments of the collection, shortest last.
     * Similar to applying tail successively and collecting all results in one list.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#tails
     *
     * @return Collection<int, list<T>>
     */
    public function tails(): Collection;
}
