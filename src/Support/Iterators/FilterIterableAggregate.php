<?php

declare(strict_types=1);

namespace Ody\Core\Support\Iterators;

use Closure;
use Generator;
use IteratorAggregate;

/**
 * @template TKey
 * @template T
 *
 * @implements IteratorAggregate<TKey, T>
 */
final class FilterIterableAggregate implements IteratorAggregate
{
    /**
     * @param iterable<TKey, T> $iterable
     * @param (Closure(T, TKey, iterable<TKey, T>): bool) $predicate
     */
    public function __construct(private iterable $iterable, private Closure $predicate) {}

    /**
     * @return Generator<TKey, T>
     */
    public function getIterator(): Generator
    {
        foreach ($this->iterable as $key => $value) {
            if (($this->predicate)($value, $key, $this->iterable)) {
                yield $key => $value;
            }
        }
    }
}
