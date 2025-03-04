<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Pluckable
{
    /**
     * Retrieves all of the values of a collection for a given key.
     * Nested values can be retrieved using “dot notation” and the wildcard character `*`.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#pluck
     *
     * @param array<int, string>|array-key $pluck
     *
     * @return Collection<int, iterable<int, T>|T>
     */
    public function pluck(mixed $pluck, mixed $default = null): Collection;
}
