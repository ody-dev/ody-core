<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Dropable
{
    /**
     * Drop the `n` first items of the collection.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#drop
     *
     * @return Collection<TKey, T>
     */
    public function drop(int $count): Collection;
}
