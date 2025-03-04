<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Unpackable
{
    /**
     * Opposite of `pack`, transforms groupings of items representing a key and a value into actual keys and values.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#unpack
     *
     * @return Collection<TKey, T>
     */
    public function unpack(): Collection;
}
