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
final class Merge extends AbstractOperation
{
    /**
     * @return Closure(iterable<TKey, T> ...$sources): Closure(iterable<TKey, T>): Generator<TKey, T>
     */
    public function __invoke(): Closure
    {
        return
            /**
             * @param iterable<TKey, T> ...$sources
             */
            static fn (iterable ...$sources): Closure =>
                /**
                 * @param iterable<TKey, T> $iterable
                 *
                 * @return Generator<TKey, T>
                 */
                static fn (iterable $iterable): Generator => yield from new ConcatIterableAggregate([$iterable, ...array_values($sources)]);
    }
}
