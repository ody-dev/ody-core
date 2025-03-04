<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Frequencyable
{
    /**
     * Calculate the frequency of the items in the collection
     * Returns a new key-value collection with frequencies as keys.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#frequency
     *
     * @return Collection<int, T>
     */
    public function frequency(): Collection;
}
