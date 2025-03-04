<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

use Ody\Core\Support\Collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Unwindowable
{
    /**
     * Opposite of `window`, usually needed after a call to that operation.
     * Turns already-created windows back into a flat list.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#unwindow
     *
     * @return Collection<TKey, T>
     */
    public function unwindow(): Collection;
}
