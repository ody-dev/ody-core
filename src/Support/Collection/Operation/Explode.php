<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Operation;

use Closure;
use Generator;
use Ody\Core\Support\Collection\Contract\Operation\Splitable;

/**
 * @immutable
 *
 * @template TKey
 * @template T
 */
final class Explode extends AbstractOperation
{
    /**
     * @return Closure(array<T>): Closure(iterable<TKey, T>): Generator<int, list<T>>
     */
    public function __invoke(): Closure
    {
        return
            /**
             * @param array<T> $explodes
             *
             * @return Closure(iterable<TKey, T>): Generator<int, list<T>>
             */
            static function (array $explodes): Closure {
                /** @var Closure(iterable<TKey, T>): Generator<int, list<T>> $split */
                $split = (new Split())()(Splitable::REMOVE)(
                    ...array_map(
                        /**
                         * @param T $explode
                         */
                        static fn (mixed $explode): Closure =>
                            /**
                             * @param T $value
                             */
                            static fn (mixed $value): bool => $value === $explode,
                        $explodes
                    )
                );

                // Point free style.
                return $split;
            };
    }
}
