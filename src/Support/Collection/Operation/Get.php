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
final class Get extends AbstractOperation
{
    /**
     * @template V
     *
     * @return Closure(TKey): Closure(V): Closure(iterable<TKey, T>): Generator<TKey, T|V>
     */
    public function __invoke(): Closure
    {
        return
            /**
             * @param TKey $keyToGet
             *
             * @return Closure(V): Closure(iterable<TKey, T>): Generator<TKey, T|V>
             */
            static fn (mixed $keyToGet): Closure =>
                /**
                 * @param V $default
                 *
                 * @return Closure(iterable<TKey, T>): Generator<TKey, T|V>
                 */
                static function (mixed $default) use ($keyToGet): Closure {
                    /** @var Closure(iterable<TKey, T>): (Generator<TKey, T|V>) $pipe */
                    $pipe = (new Pipe())()(
                        (new Filter())()(
                            /**
                             * @param T $value
                             * @param TKey $key
                             */
                            static fn (mixed $value, mixed $key): bool => $key === $keyToGet
                        ),
                        (new Append())()([$default]),
                        (new Head())()
                    );

                    // Point free style.
                    return $pipe;
                };
    }
}
