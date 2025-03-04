<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Splitable
{
    public const AFTER = 1;

    public const BEFORE = -1;

    public const REMOVE = 0;

    /**
     * Split a collection using one or more callbacks.
     *
     * A flag must be provided in order to specify whether the value used to split the collection
     * should be added at the end of a chunk, at the beginning of a chunk, or completely removed.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#split
     *
     * @return Collection<int, list<T>>
     */
    public function split(int $type = Splitable::BEFORE, callable ...$callbacks): Collection;
}
