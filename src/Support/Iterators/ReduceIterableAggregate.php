<?php

declare(strict_types=1);

namespace Ody\Core\Support\Iterators;

use Closure;
use Generator;
use IteratorAggregate;

/**
 * @template TKey
 * @template T
 * @template W
 *
 * @implements IteratorAggregate<int, W>
 */
final class ReduceIterableAggregate implements IteratorAggregate
{
    /**
     * @param iterable<TKey, T> $iterable
     * @param (Closure(W, T, TKey, iterable<TKey, T>): W) $closure
     * @param W $initial
     */
    public function __construct(private iterable $iterable, private Closure $closure, private mixed $initial) {}

    /**
     * @return Generator<int, W>
     */
    public function getIterator(): Generator
    {
        $initial = $this->initial;

        foreach ($this->iterable as $key => $value) {
            $initial = ($this->closure)($initial, $value, $key, $this->iterable);
        }

        yield $initial;
    }
}
