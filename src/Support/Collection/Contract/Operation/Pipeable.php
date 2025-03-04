<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Pipeable
{
    /**
     * Pipe together multiple operations and apply them in succession to the collection items.
     * To maintain a lazy nature, each operation needs to return a `Generator`.
     * Custom operations and operations provided in the API can be combined together.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#pipe
     *
     * @param callable(iterable<TKey, T>): iterable<TKey, T> ...$callbacks
     *
     * @return Collection<TKey, T>
     */
    public function pipe(callable ...$callbacks): Collection;
}
