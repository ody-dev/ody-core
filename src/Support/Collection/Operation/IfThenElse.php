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
final class IfThenElse extends AbstractOperation
{
    /**
     * @return Closure(callable(T, TKey, iterable<TKey, T>): bool): Closure(callable(T, TKey, iterable<TKey, T>): T): Closure(callable(T, TKey, iterable<TKey, T>): T): Closure(iterable<TKey, T>): Generator<TKey, T>
     */
    public function __invoke(): Closure
    {
        return
            /**
             * @param callable(T, TKey, iterable<TKey, T>): bool $condition
             *
             * @return Closure(callable(T, TKey, iterable<TKey, T>): T): Closure(callable(T, TKey, iterable<TKey, T>): T): Closure(iterable<TKey, T>): Generator<TKey, T>
             */
            static fn (callable $condition): Closure =>
                /**
                 * @param callable(T, TKey, iterable<TKey, T>): T $then
                 *
                 * @return Closure(callable(T, TKey, iterable<TKey, T>): T): Closure(iterable<TKey, T>): Generator<TKey, T>
                 */
                static fn (callable $then): Closure =>
                    /**
                     * @param callable(T, TKey, iterable<TKey, T>):T $else
                     *
                     * @return Closure(iterable<TKey, T>): Generator<TKey, T>
                     */
                    static function (callable $else) use ($condition, $then): Closure {
                        /** @var Closure(iterable<TKey, T>): Generator<TKey, T> $map */
                        $map = (new Map())()(
                            /**
                             * @param T $value
                             * @param TKey $key
                             * @param iterable<TKey, T> $iterable
                             *
                             * @return T
                             */
                            static fn (mixed $value, mixed $key, iterable $iterable): mixed => $condition($value, $key, $iterable) ? $then($value, $key, $iterable) : $else($value, $key, $iterable)
                        );

                        // Point free style.
                        return $map;
                    };
    }
}
