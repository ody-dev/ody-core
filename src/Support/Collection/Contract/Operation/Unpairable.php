<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Unpairable
{
    /**
     * Opposite of `pair`, creates a flat list of values from a collection of key-value pairs.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#unpair
     *
     * @return Collection<int, TKey|T>
     */
    public function unpair(): Collection;
}
