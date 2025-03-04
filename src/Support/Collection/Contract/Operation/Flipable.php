<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Flipable
{
    /**
     * Flip keys and items in a collection.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#flip
     *
     * @return Collection<T, TKey>
     */
    public function flip(): Collection;
}
