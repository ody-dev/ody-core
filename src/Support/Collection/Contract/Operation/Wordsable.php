<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Wordsable
{
    /**
     * Get a list of words from a string, splitting based on the character set: \t, \n, ' '.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#words
     *
     * @return Collection<TKey, string>
     */
    public function words(): Collection;
}
