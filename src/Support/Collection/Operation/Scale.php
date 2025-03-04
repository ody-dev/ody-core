<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Operation;

use Closure;
use Generator;

use const INF;

/**
 * @immutable
 *
 * @template TKey
 * @template T
 */
final class Scale extends AbstractOperation
{
    /**
     * @return Closure(float): Closure(float): Closure(float): Closure(float): Closure(float): Closure(iterable<TKey, float|int>): Generator<TKey, float|int>
     */
    public function __invoke(): Closure
    {
        return
            /**
             * @return Closure(float): Closure(float): Closure(float): Closure(float): Closure(iterable<TKey, float|int>): Generator<TKey, float|int>
             */
            static fn (float $lowerBound): Closure =>
                /**
                 * @return Closure(float): Closure(float): Closure(float): Closure(iterable<TKey, float|int>): Generator<TKey, float|int>
                 */
                static fn (float $upperBound): Closure =>
                    /**
                     * @return Closure(float): Closure(float): Closure(iterable<TKey, float|int>): Generator<TKey, float|int>
                     */
                    static fn (float $wantedLowerBound = 0.0): Closure =>
                        /**
                         * @return Closure(float): Closure(iterable<TKey, float|int>): Generator<TKey, float|int>
                         */
                        static fn (float $wantedUpperBound = 1.0): Closure =>
                            /**
                             * @return Closure(iterable<TKey, float|int>): Generator<TKey, float|int>
                             */
                            static function (float $base = 0.0) use ($lowerBound, $upperBound, $wantedLowerBound, $wantedUpperBound): Closure {
                                $wantedLowerBound = (0.0 === $wantedLowerBound) ? (0.0 === $base ? 0.0 : 1.0) : $wantedLowerBound;
                                $wantedUpperBound = (1.0 === $wantedUpperBound) ? (0.0 === $base ? 1.0 : $base) : $wantedUpperBound;

                                $mapper = (new Map())()(
                                    static function (float|int $v) use ($lowerBound, $upperBound, $wantedLowerBound, $wantedUpperBound, $base): float {
                                        $mx = 0.0 === $base ?
                                            ($v - $lowerBound) / ($upperBound - $lowerBound) :
                                            log($v - $lowerBound, $base) / log($upperBound - $lowerBound, $base);

                                        $mx = $mx === -INF ? 0 : $mx;

                                        return $wantedLowerBound + $mx * ($wantedUpperBound - $wantedLowerBound);
                                    }
                                );

                                $filter = (new Filter())()(
                                    static fn (float|int $item): bool => $item > $lowerBound,
                                    static fn (float|int $item): bool => $item <= $upperBound
                                );

                                /** @var Closure(iterable<TKey, (float|int)>):(Generator<TKey, float|int>) $pipe */
                                $pipe = (new Pipe())()($filter, $mapper);

                                // Point free style.
                                return $pipe;
                            };
    }
}
