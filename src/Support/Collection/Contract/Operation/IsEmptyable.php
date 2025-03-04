<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

/**
 * @template TKey
 * @template T
 */
interface IsEmptyable
{
    /**
     * Check if a collection has no elements inside.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#isempty
     */
    public function isEmpty(): bool;
}
