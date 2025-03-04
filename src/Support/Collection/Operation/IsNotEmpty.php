<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Operation;

use Closure;
use Generator;
use Ody\Core\Support\Iterators\IterableIteratorAggregate;

/**
 * @immutable
 *
 * @template TKey
 * @template T
 */
final class IsNotEmpty extends AbstractOperation
{
    /**
     * @return Closure(iterable<TKey, T>): Generator<int, bool>
     */
    public function __invoke(): Closure
    {
        return static fn (iterable $iterable): Generator => yield (new IterableIteratorAggregate($iterable))->getIterator()->valid();
    }
}
