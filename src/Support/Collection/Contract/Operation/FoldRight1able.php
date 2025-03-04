<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract\Operation;

/**
 * @template TKey
 * @template T
 */
interface FoldRight1able
{
    /**
     * @template V
     *
     * @param callable((T|V), T, TKey, iterable<TKey, T>): V $callback
     *
     * @return V
     */
    public function foldRight1(callable $callback): mixed;
}
