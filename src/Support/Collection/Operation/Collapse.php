<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Operation;

use Closure;
use Generator;

/**
 * @immutable
 *
 * @template TKey
 * @template T
 */
final class Collapse extends AbstractOperation
{
    /**
     * @return Closure(iterable<TKey, (T|iterable<TKey, T>)>): Generator<TKey, T>
     */
    public function __invoke(): Closure
    {
        $filterCallback =
            /**
             * @param T $value
             */
            static fn (mixed $value): bool => is_iterable($value);

        /** @var Closure(iterable<TKey, (T|iterable<TKey, T>)>): Generator<TKey, T> $pipe */
        $pipe = (new Pipe())()(
            (new Filter())()($filterCallback),
            (new Flatten())()(1),
        );

        // Point free style.
        return $pipe;
    }
}
