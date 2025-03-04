<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Groupable
{
    /**
     * Takes a list and returns a list of lists such that the concatenation of the result is equal to the argument.
     * Moreover, each sublist in the result contains only equal elements.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#group
     *
     * @return Collection<int, list<T>>
     */
    public function group(): Collection;
}
