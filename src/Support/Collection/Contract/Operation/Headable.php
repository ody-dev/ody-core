<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

/**
 * @template TKey
 * @template T
 */
interface Headable
{
    /**
     * Get the first item from the collection in a separate collection. Same as `first`.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#head
     *
     * @template V
     *
     * @param V $default
     *
     * @return T|V
     */
    public function head(mixed $default = null);
}
