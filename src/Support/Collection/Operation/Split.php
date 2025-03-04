<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Operation;

use Closure;
use Generator;
use Ody\Core\Support\Collection\Contract\Operation\Splitable;
use Ody\Core\Support\Collection\Utils\CallbacksArrayReducer;

/**
 * @immutable
 *
 * @template TKey
 * @template T
 */
final class Split extends AbstractOperation
{
    /**
     * @return Closure(int): Closure((callable(T, TKey): bool)...): Closure(iterable<TKey, T>): Generator<int, list<T>>
     */
    public function __invoke(): Closure
    {
        return
            /**
             * @return Closure((callable(T, TKey): bool)...): Closure(iterable<TKey, T>): Generator<int, list<T>>
             */
            static fn (int $type = Splitable::BEFORE): Closure =>
                /**
                 * @param callable(T, TKey): bool ...$callbacks
                 *
                 * @return Closure(iterable<TKey, T>): Generator<int, list<T>>
                 */
                static fn (callable ...$callbacks): Closure =>
                    /**
                     * @param iterable<TKey, T> $iterable
                     *
                     * @return Generator<int, list<T>>
                     */
                    static function (iterable $iterable) use ($type, $callbacks): Generator {
                        $carry = [];
                        $callback = CallbacksArrayReducer::or()($callbacks);

                        foreach ($iterable as $key => $current) {
                            $callbackReturn = $callback($current, $key, $iterable);

                            if (Splitable::AFTER === $type) {
                                $carry[] = $current;
                            }

                            if ($callbackReturn && (Splitable::REMOVE === $type)) {
                                yield $carry;

                                $carry = [];

                                continue;
                            }

                            if ($callbackReturn && ([] !== $carry)) {
                                yield $carry;

                                $carry = [];
                            }

                            if (Splitable::AFTER !== $type) {
                                $carry[] = $current;
                            }
                        }

                        if ([] !== $carry) {
                            yield $carry;
                        }
                    };
    }
}
