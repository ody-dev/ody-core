<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

use const PHP_INT_MAX;

/**
 * @template TKey
 * @template T
 */
interface Flattenable
{
    /**
     * Flatten a collection of items into a simple flat collection.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#flatten
     *
     * @return Collection<mixed, mixed>
     */
    public function flatten(int $depth = PHP_INT_MAX): Collection;
}
