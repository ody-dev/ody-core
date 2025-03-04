<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Operation;

use Closure;
use Generator;
use Ody\Core\Support\Collection\Utils\CallbacksArrayReducer;

/**
 * @immutable
 *
 * @template TKey
 * @template T
 */
final class Every extends AbstractOperation
{
    /**
     * @return Closure(...callable(int, T, TKey, iterable<TKey, T>): bool): Closure(iterable<TKey, T>): Generator<int, bool>
     */
    public function __invoke(): Closure
    {
        return
            /**
             * @param callable(int, T, TKey, iterable<TKey, T>): bool ...$predicates
             *
             * @return Closure(iterable<TKey, T>): Generator<int, bool>
             */
            static fn (callable ...$predicates): Closure => static function (iterable $iterable) use ($predicates): Generator {
                $predicate = CallbacksArrayReducer::or()($predicates);

                /** @var Generator<int, array{0: TKey, 1:T}> $packed */
                $packed = (new Pack())()($iterable);

                foreach ($packed as $index => [$key, $value]) {
                    if (false === $predicate($index, $value, $key, $iterable)) {
                        return yield $index => false;
                    }
                }

                yield true;
            };
    }
}
