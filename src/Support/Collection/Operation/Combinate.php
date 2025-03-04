<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Operation;

use Closure;
use Generator;

use function array_slice;
use function count;

/**
 * @immutable
 *
 * @template TKey
 * @template T
 */
final class Combinate extends AbstractOperation
{
    public function __invoke(): Closure
    {
        return static function (?int $length = null): Closure {
            $getCombinations =
                /**
                 * @param array<int, T> $dataset
                 *
                 * @return Generator<array<int, T>>
                 */
                static function (array $dataset, int $length) use (&$getCombinations): Generator {
                    for ($i = 0; count($dataset) - $length >= $i; ++$i) {
                        if (1 === $length) {
                            yield [$dataset[$i]];

                            continue;
                        }

                        /** @var array<int, T> $permutation */
                        foreach ($getCombinations(array_slice($dataset, $i + 1), $length - 1) as $permutation) {
                            array_unshift($permutation, $dataset[$i]);

                            yield $permutation;
                        }
                    }
                };

            return
                /**
                 * @param iterable<TKey, T> $iterable
                 *
                 * @return Generator<int, array<int, T>>
                 */
                static function (iterable $iterable) use ($length, $getCombinations): Generator {
                    /** @psalm-suppress InvalidOperand */
                    $dataset = [...$iterable];

                    if (0 < $length) {
                        return yield from $getCombinations($dataset, $length);
                    }

                    $collectionSize = count($dataset);

                    if (0 === $length) {
                        return yield from $getCombinations($dataset, $collectionSize);
                    }

                    for ($i = 1; $i <= $collectionSize; ++$i) {
                        yield from $getCombinations($dataset, $i);
                    }
                };
        };
    }
}
