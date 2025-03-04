<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Unzipable
{
    /**
     * Opposite of `zip`, splits zipped items in a collection.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#unzip
     *
     * @return Collection<int, list<T>>
     */
    public function unzip(): Collection;
}
