<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Operation;

use Closure;
use Ody\Core\Support\Iterators\InfiniteIteratorAggregate;
use Ody\Core\Support\Iterators\IterableIteratorAggregate;

/**
 * @immutable
 *
 * @template TKey
 * @template T
 */
final class Cycle extends AbstractOperation
{
    /**
     * @return Closure(iterable<TKey, T>): iterable<TKey, T>
     */
    public function __invoke(): Closure
    {
        return
            /**
             * @param iterable<TKey, T> $iterable
             *
             * @return iterable<TKey, T>
             */
            static function (iterable $iterable): iterable {
                yield from new InfiniteIteratorAggregate((new IterableIteratorAggregate($iterable))->getIterator());
            };
    }
}
