<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Operation;

use Closure;
use Generator;
use Ody\Core\Support\Iterators\MultipleIterableAggregate;
use MultipleIterator;

/**
 * @immutable
 *
 * @template TKey
 * @template T
 */
final class Zip extends AbstractOperation
{
    /**
     * @template UKey
     * @template U
     *
     * @return Closure(iterable<UKey, U>...): Closure(iterable<TKey, T>): Generator<list<TKey|UKey|null>, list<T|U|null>>
     */
    public function __invoke(): Closure
    {
        return
            /**
             * @param iterable<UKey, U> ...$iterables
             *
             * @return Closure(iterable<TKey, T>): Generator<list<TKey|UKey|null>, list<T|U|null>>
             */
            static fn (iterable ...$iterables): Closure =>
                /**
                 * @param iterable<TKey, T> $iterable
                 *
                 * @return Generator<list<TKey|UKey|null>, list<T|U|null>>
                 */
                static fn (iterable $iterable): Generator => yield from new MultipleIterableAggregate([$iterable, ...array_values($iterables)], MultipleIterator::MIT_NEED_ANY);
    }
}
