<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Untilable
{
    /**
     * Iterate over the collection items until the provided callback(s) are satisfied.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#until
     *
     * @param callable(T, TKey, iterable<TKey, T>):bool ...$callbacks
     *
     * @return Collection<TKey, T>
     */
    public function until(callable ...$callbacks): Collection;
}
