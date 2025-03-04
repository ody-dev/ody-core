<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Operation;

use Closure;
use Generator;
use Ody\Core\Support\Iterators\UnpackIterableAggregate;

/**
 * @immutable
 *
 * @template TKey
 * @template T
 */
final class Unpack extends AbstractOperation
{
    /**
     * @return Closure(iterable<mixed, array{0: TKey, 1: T}>): Generator<TKey, T>
     */
    public function __invoke(): Closure
    {
        return
           /**
            * @param iterable<mixed, array{0: TKey, 1: T}> $iterable
            */
           static fn (iterable $iterable): Generator => yield from new UnpackIterableAggregate($iterable);
    }
}
