<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Squashable
{
    /**
     * Eagerly apply operations in a collection rather than lazily.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#squash
     *
     * @return Collection<TKey, T>
     */
    public function squash(): Collection;
}
