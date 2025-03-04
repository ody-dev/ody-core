<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Windowable
{
    /**
     * Loop the collection yielding windows of data by adding a given number of items to the current item.
     * Initially the windows yielded will be smaller, until size `1 + $size` is reached.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#window
     *
     * @return Collection<TKey, list<T>>
     */
    public function window(int $size): Collection;
}
