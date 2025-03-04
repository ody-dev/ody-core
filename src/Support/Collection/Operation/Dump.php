<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Operation;

use Closure;
use Generator;
use Symfony\Component\VarDumper\VarDumper;

/**
 * @immutable
 *
 * @template TKey
 * @template T
 */
final class Dump extends AbstractOperation
{
    /**
     * @return Closure(string): Closure(int): Closure(?Closure): Closure(iterable<TKey, T>): Generator<TKey, T>
     */
    public function __invoke(): Closure
    {
        return
            /**
             * @return Closure(int): Closure(?Closure): Closure(iterable<TKey, T>): Generator<TKey, T>
             */
            static fn (string $name = ''): Closure =>
                /**
                 * @return Closure(?Closure): Closure(iterable<TKey, T>): Generator<TKey, T>
                 */
                static fn (int $size = -1): Closure =>
                    /**
                     * @return Closure(iterable<TKey, T>): Generator<TKey, T>
                     */
                    static fn (?Closure $callback = null): Closure =>
                        /**
                         * @param iterable<TKey, T> $iterable
                         *
                         * @return Generator<TKey, T>
                         */
                        static function (iterable $iterable) use ($name, $size, $callback): Generator {
                            $j = 0;

                            /** @var callable $debugFunction */
                            $debugFunction = class_exists(VarDumper::class) ? 'dump' : 'var_dump';

                            $callback ??=
                                /**
                                 * @param TKey $key
                                 * @param T $value
                                 */
                                static fn (string $name, mixed $key, mixed $value): mixed => $debugFunction(['name' => $name, 'key' => $key, 'value' => $value]);

                            foreach ($iterable as $key => $value) {
                                yield $key => $value;

                                if (-1 === $size) {
                                    continue;
                                }

                                if ($j++ < $size || 0 === $size) {
                                    $callback($name, $key, $value);

                                    continue;
                                }

                                $size = -1;
                            }
                        };
    }
}
