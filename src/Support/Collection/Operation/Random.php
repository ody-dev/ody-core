<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Operation;

use Closure;
use Generator;
use Ody\Core\Support\Iterators\LimitIterableAggregate;
use Ody\Core\Support\Iterators\RandomIterableAggregate;

/**
 * @immutable
 *
 * @template TKey
 * @template T
 */
final class Random extends AbstractOperation
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
            static fn (int $seed): Closure =>
                /**
                 * @return Closure(iterable<TKey, T>): Generator<TKey, T>
                 */
                static fn (int $size): Closure =>
                    /**
                     * @param iterable<TKey, T> $iterable
                     *
                     * @return Generator<TKey, T>
                     */
                    static function (iterable $iterable) use ($seed, $size): Generator {
                        // Point free style.
                        yield from new LimitIterableAggregate(new RandomIterableAggregate($iterable, $seed), 0, $size);
                    };
    }
}
