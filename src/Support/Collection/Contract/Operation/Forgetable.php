<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Forgetable
{
    /**
     * Remove items having specific keys.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#forget
     *
     * @return Collection<TKey, T>
     */
    public function forget(mixed ...$keys): Collection;
}
