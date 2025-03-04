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
final class FoldRight1 extends AbstractOperation
{
    /**
     * @template V
     *
     * @return Closure(callable((T|V), T, TKey, iterable<TKey, T>): V): Closure(iterable<TKey, T>): Generator<int|TKey, V>
     */
    public function __invoke(): Closure
    {
        return
            /**
             * @param callable((T|V), T, TKey, iterable<TKey, T>): V $callback
             *
             * @return Closure(iterable<TKey, T>): Generator<int|TKey, V>
             */
            static function (callable $callback): Closure {
                /** @var Closure(iterable<TKey, T>):(Generator<int|TKey, V>) $pipe */
                $pipe = (new Pipe())()(
                    (new ScanRight1())()($callback),
                    (new Head())()
                );

                // Point free style.
                return $pipe;
            };
    }
}
