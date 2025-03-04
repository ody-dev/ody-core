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
 * @implements IteratorAggregate<TKey, W>
 */
final class MapIterableAggregate implements IteratorAggregate
{
    /**
     * @param iterable<TKey, T> $iterable
     * @param (Closure(T, TKey, iterable<TKey, T>): W) $closure
     */
    public function __construct(private iterable $iterable, private Closure $closure) {}

    /**
     * @return Generator<TKey, W>
     */
    public function getIterator(): Generator
    {
        foreach ($this->iterable as $key => $value) {
            yield $key => ($this->closure)($value, $key, $this->iterable);
        }
    }
}
