<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Padable
{
    /**
     * Pad a collection to the given length with a given value.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#pad
     *
     * @template U
     *
     * @param U $value
     *
     * @return Collection<int|TKey, T|U>
     */
    public function pad(int $size, mixed $value): Collection;
}
