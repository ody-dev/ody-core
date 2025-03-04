<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Operation;

use Closure;
use Generator;
use Ody\Core\Support\Iterators\LimitIterableAggregate;

/**
 * @immutable
 *
 * @template TKey
 * @template T
 */
final class Limit extends AbstractOperation
{
    /**
     * @return Closure(int): Closure(int): Closure(iterable<TKey, T>): Generator<TKey, T>
     */
    public function __invoke(): Closure
    {
        return
            /**
             * @return Closure(int): Closure(iterable<TKey, T>): Generator<TKey, T>
             */
            static fn (int $count = -1): Closure =>
                /**
                 * @return Closure(iterable<TKey, T>): Generator<TKey, T>
                 */
                static fn (int $offset = 0): Closure =>
                    /**
                     * @param iterable<TKey, T> $iterable
                     *
                     * @return Generator<TKey, T>
                     */
                    static fn (iterable $iterable): Generator => yield from new LimitIterableAggregate($iterable, $offset, $count);
    }
}
