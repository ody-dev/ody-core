<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Operation;

use Closure;
use Generator;
use Ody\Core\Support\Iterators\NormalizeIterableAggregate;

/**
 * @immutable
 *
 * @template TKey
 * @template T
 */
final class Normalize extends AbstractOperation
{
    /**
     * @return Closure(iterable<TKey, T>): Generator<int, T>
     */
    public function __invoke(): Closure
    {
        return
            /**
             * @param iterable<TKey, T> $iterable
             *
             * @return Generator<int, T>
             */
            static fn (iterable $iterable): Generator => yield from new NormalizeIterableAggregate($iterable);
    }
}
