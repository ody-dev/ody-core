<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Initable
{
    /**
     * Returns the collection without its last item.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#init
     *
     * @return Collection<TKey, T>
     */
    public function init(): Collection;
}
