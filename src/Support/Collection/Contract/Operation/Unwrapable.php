<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Unwrapable
{
    /**
     * Opposite of `wrap`, turn a collection of arrays into a flat list.
     * Equivalent to `flatten(1)`.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#unwrap
     *
     * @return Collection<mixed, mixed>
     */
    public function unwrap(): Collection;
}
