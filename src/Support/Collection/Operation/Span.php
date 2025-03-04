<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Operation;

use Closure;
use Generator;
use Ody\Core\Support\Iterators\CachingIteratorAggregate;
use Ody\Core\Support\Iterators\ClosureIteratorAggregate;
use Ody\Core\Support\Iterators\IterableIteratorAggregate;

/**
 * @immutable
 *
 * @template TKey
 * @template T
 */
final class Span extends AbstractOperation
{
    /**
     * @return Closure(callable(T, TKey, iterable<TKey, T>): bool ...): Closure(iterable<TKey, T>): Generator<int, iterable<TKey, T>>
     */
    public function __invoke(): Closure
    {
        /**
         * @param callable(T, TKey, iterable<TKey, T>): bool ...$callbacks
         *
         * @return Closure(iterable<TKey, T>): Generator<int, iterable<TKey, T>>
         */
        return static fn (callable ...$callbacks): Closure =>
            /**
             * @param iterable<TKey, T> $iterable
             *
             * @return Generator<int, iterable<TKey, T>>
             */
            static function (iterable $iterable) use ($callbacks): Generator {
                $iteratorAggregate = new CachingIteratorAggregate((new IterableIteratorAggregate($iterable))->getIterator());

                yield new ClosureIteratorAggregate((new TakeWhile())()(...$callbacks), [$iteratorAggregate]);

                yield new ClosureIteratorAggregate((new DropWhile())()(...$callbacks), [$iteratorAggregate]);
            };
    }
}
