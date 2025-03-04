<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Limitable
{
    /**
     * Limit the number of values in the collection.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#limit
     *
     * @return Collection<TKey, T>
     */
    public function limit(int $count = -1, int $offset = 0): Collection;
}
