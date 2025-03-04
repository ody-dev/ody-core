<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface MapNable
{
    /**
     * Apply one or more callbacks to every item of a collection and use the return value.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#mapn
     *
     * @param callable(mixed, mixed, iterable<TKey, T>): mixed ...$callbacks
     *
     * @return Collection<mixed, mixed>
     */
    public function mapN(callable ...$callbacks): Collection;
}
