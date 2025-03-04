<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Operation;

use Closure;
use Generator;
use Ody\Core\Support\Iterators\ConcatIterableAggregate;

/**
 * @immutable
 *
 * @template TKey
 * @template T
 */
final class Append extends AbstractOperation
{
    /**
     * @template U
     *
     * @return Closure(array<U>): Closure(iterable<TKey, T>): Generator<int|TKey, T|U>
     */
    public function __invoke(): Closure
    {
        return
            /**
             * @param array<U> $items
             *
             * @return Closure(iterable<TKey, T>): Generator<int|TKey, T|U>
             */
            static fn (array $items): Closure =>
                /**
                 * @param iterable<TKey, T> $iterable
                 *
                 * @return Generator<int|TKey, T|U>
                 */
                static fn (iterable $iterable): Generator => yield from new ConcatIterableAggregate([$iterable, $items]);
    }
}
