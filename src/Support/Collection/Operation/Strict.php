<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Operation;

use Closure;
use Generator;
use Ody\Core\Support\Iterators\IterableIteratorAggregate;
use Ody\Core\Support\Iterators\TypedIterableAggregate;

/**
 * @immutable
 *
 * @template TKey
 * @template T
 */
final class Strict extends AbstractOperation
{
    /**
     * @return Closure(null|callable(mixed): string): Closure(iterable<TKey, T>): Generator<TKey, T>
     */
    public function __invoke(): Closure
    {
        return
            /**
             * @param null|callable(mixed): string $callback
             *
             * @return Closure(iterable<TKey, T>): Generator<TKey, T>
             */
            static fn (?callable $callback = null): Closure =>
                /**
                 * @return Generator<TKey, T>
                 */
                static fn (iterable $iterator): Generator => yield from new TypedIterableAggregate((new IterableIteratorAggregate($iterator))->getIterator(), $callback);
    }
}
