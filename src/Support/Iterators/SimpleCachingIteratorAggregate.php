<?php

declare(strict_types=1);

namespace Ody\Core\Support\Iterators;

use CachingIterator;
use Generator;
use Iterator;
use IteratorAggregate;

/**
 * @template TKey
 * @template T
 *
 * @implements IteratorAggregate<array-key|TKey, T>
 *
 * This iterator must be used only if keys are int|string. When it is used with
 * keys of different type, during the first loop keys are ok, but during the
 * next loops, keys are replaced by integers.
 * This is mostly due to the fact that the method
 * CachingIterator::getCache returns an array, and keys of an array can only be
 * int|string.
 * In order to circumvent that, use CachingIteratorAggregate instead.
 */
final class SimpleCachingIteratorAggregate implements IteratorAggregate
{
    private CachingIterator $iterator;

    /**
     * @param Iterator<TKey, T> $iterator
     */
    public function __construct(Iterator $iterator)
    {
        $this->iterator = new CachingIterator(
            $iterator,
            CachingIterator::FULL_CACHE
        );
    }

    /**
     * @return Generator<array-key|TKey, T>
     */
    public function getIterator(): Generator
    {
        yield from $this->iterator->getCache();

        while ($this->iterator->hasNext()) {
            $this->iterator->next();

            yield $this->iterator->key() => $this->iterator->current();
        }
    }

    public function hasNext(): bool
    {
        return $this->iterator->hasNext();
    }
}
