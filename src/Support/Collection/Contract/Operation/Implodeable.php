<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

/**
 * @template TKey
 * @template T
 */
interface Implodeable
{
    /**
     * Join all the elements of the collection into a single string
     * using a glue provided or the empty string as default.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#implode
     */
    public function implode(string $glue = ''): string;
}
