<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Chunkable
{
    /**
     * Chunk a collection of items into chunks of items of a given size.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#chunk
     *
     * @return Collection<int, non-empty-list<T>>
     */
    public function chunk(int ...$sizes): Collection;
}
