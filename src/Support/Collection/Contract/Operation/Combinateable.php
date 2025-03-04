<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Combinateable
{
    /**
     * Get all the combinations of a given length of a collection of items.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#combinate
     *
     * @return Collection<TKey, T>
     */
    public function combinate(?int $length = null): Collection;
}
