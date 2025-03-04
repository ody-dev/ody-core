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
final class Max extends AbstractOperation
{
    /**
     * @return Closure(iterable<TKey, T>): Generator<TKey, T>
     */
    public function __invoke(): Closure
    {
        $comparator =
            /**
             * @param T $carry
             * @param T $value
             *
             * @return T
             */
            static fn (mixed $carry, mixed $value): mixed => max($value, $carry);

        return (new Compare())()($comparator);
    }
}
