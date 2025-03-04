<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Operation;

use Closure;
use Generator;
use Ody\Core\Support\Iterators\ReduceIterableAggregate;

/**
 * @immutable
 *
 * @template TKey
 * @template T
 */
final class FoldLeft extends AbstractOperation
{
    /**
     * @template V
     *
     * @return Closure(callable(V, T, TKey, iterable<TKey, T>): V): Closure(V): Closure(iterable<TKey, T>): Generator<int, V>
     */
    public function __invoke(): Closure
    {
        return
            /**
             * @param callable(V, T, TKey, iterable<TKey, T>): V $callback
             *
             * @return Closure(V): Closure(iterable<TKey, T>): Generator<int, V>
             */
            static fn (callable $callback): Closure =>
                /**
                 * @param V $initial
                 *
                 * @return Closure(iterable<TKey, T>): Generator<int, V>
                 */
                static fn (mixed $initial): Closure =>
                    /**
                     * @param iterable<TKey, T> $iterable
                     *
                     * @return Generator<int, V>
                     */
                    static fn (iterable $iterable): Generator => yield from new ReduceIterableAggregate($iterable, Closure::fromCallable($callback), $initial);
    }
}
