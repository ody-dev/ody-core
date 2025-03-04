<?php

declare(strict_types=1);

namespace Ody\Core\Support\Iterators;

use Generator;
use Iterator;

/**
 * @template TKey
 * @template T
 *
 * @implements Iterator<TKey, T>
 */
final class IterableIterator implements Iterator
{
    /**
     * @var ClosureIterator<TKey, T>
     */
    private ClosureIterator $iterator;

    /**
     * @param iterable<TKey, T> $iterable
     */
    public function __construct(iterable $iterable)
    {
        $this->iterator = new ClosureIterator(
            /**
             * @param iterable<TKey, T> $iterable
             *
             * @return Generator<TKey, T>
             */
            static fn (iterable $iterable): Generator => yield from $iterable,
            [$iterable]
        );
    }

    /**
     * @return T
     */
    public function current(): mixed
    {
        return $this->iterator->current();
    }

    /**
     * @return TKey
     */
    public function key(): mixed
    {
        return $this->iterator->key();
    }

    public function next(): void
    {
        $this->iterator->next();
    }

    public function rewind(): void
    {
        $this->iterator->rewind();
    }

    public function valid(): bool
    {
        return $this->iterator->valid();
    }
}
