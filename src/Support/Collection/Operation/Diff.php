<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Operation;

use Closure;
use Generator;

use function in_array;

/**
 * @immutable
 *
 * @template TKey
 * @template T
 */
final class Diff extends AbstractOperation
{
    /**
     * @return Closure(array<T>): Closure(iterable<TKey, T>): Generator<TKey, T>
     */
    public function __invoke(): Closure
    {
        return
            /**
             * @param array<T> $values
             *
             * @return Closure(iterable<TKey, T>): Generator<TKey, T>
             */
            static fn (array $values): Closure => (new Filter())()(
                /**
                 * @param T $value
                 */
                static fn (mixed $value): bool => !in_array($value, $values, true)
            );
    }
}
