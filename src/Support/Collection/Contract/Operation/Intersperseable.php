<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Intersperseable
{
    /**
     * Insert a given value at every n element of a collection; indices are not preserved.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#intersperse
     *
     * @template U
     *
     * @param U $element
     *
     * @return Collection<TKey, T|U>
     */
    public function intersperse(mixed $element, int $every = 1, int $startAt = 0): Collection;
}
