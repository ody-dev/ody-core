<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

/**
 * @template TKey
 * @template T
 */
interface Currentable
{
    /**
     * Get the value of an item in the collection given a numeric index or the default `0`.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#current
     *
     * @template V
     *
     * @param V $default
     *
     * @return T|V
     */
    public function current(int $index = 0, mixed $default = null);
}
