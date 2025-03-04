<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface CountInAble
{
    /**
     * This operation requires a reference to a parameter that will contain the
     * amount of items in the collection. The difference with the `count`
     * operation is that the `count` operation will return the amount of items
     * in the collection and the `countIn` operation will yield over the
     * collection itself while updating the counter variable.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#countIn
     *
     * @param non-negative-int $counter
     *
     * @return Collection<TKey, T>
     */
    public function countIn(int &$counter): Collection;
}
