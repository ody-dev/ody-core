<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Coalesceable
{
    /**
     * Return the first non-nullsy value in a collection.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#coalesce
     *
     * @return Collection<TKey, T>
     */
    public function coalesce(): Collection;
}
