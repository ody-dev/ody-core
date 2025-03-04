<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Appendable
{
    /**
     * Add one or more items to a collection.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#append
     *
     * @template U
     *
     * @param U ...$items
     *
     * @return Collection<int|TKey, T|U>
     */
    public function append(mixed ...$items): Collection;
}
