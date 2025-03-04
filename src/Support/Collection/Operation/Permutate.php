<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Operation;

use Closure;
use Generator;
use Ody\Core\Support\Iterators\IterableIteratorAggregate;

/**
 * @immutable
 *
 * @template TKey
 * @template T
 */
final class Permutate extends AbstractOperation
{
    public function __invoke(): Closure
    {
        $getPermutations =
            /**
             * @param list<T> $dataset
             *
             * @return Generator<int, list<T>>
             */
            fn (array $dataset): Generator => $this->getPermutations($dataset);

        return
            /**
             * @param iterable<TKey, T> $iterable
             *
             * @return Generator<int, list<T>>
             *
             * @psalm-suppress InvalidOperand
             */
            static fn (iterable $iterable): Generator => $getPermutations([...(new IterableIteratorAggregate($iterable))]);
    }

    /**
     * @param array<array-key, T> $dataset
     *
     * @return Generator<int, list<T>>
     */
    private function getPermutations(array $dataset): Generator
    {
        foreach ($dataset as $key => $firstItem) {
            $remaining = $dataset;

            array_splice($remaining, $key, 1);

            if ([] === $remaining) {
                yield [$firstItem];

                continue;
            }

            foreach ($this->getPermutations($remaining) as $permutation) {
                // TODO: Fix this.
                array_unshift($permutation, $firstItem);

                yield $permutation;
            }
        }
    }
}
