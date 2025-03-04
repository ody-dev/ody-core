<?php

declare(strict_types=1);

namespace Ody\Core\Support\Iterators;

use Generator;
use Iterator;
use IteratorAggregate;

/**
 * @deprecated Use TypedIterableAggregate for now on.
 *
 * @template TKey
 * @template T
 *
 * @implements IteratorAggregate<TKey, T>
 */
final class TypedIteratorAggregate implements IteratorAggregate
{
    /**
     * @var TypedIterableAggregate<TKey, T>
     */
    private TypedIterableAggregate $iteratorAggregate;

    /**
     * @param Iterator<TKey, T> $iterator
     * @param callable(mixed): string $getType
     */
    public function __construct(Iterator $iterator, ?callable $getType = null)
    {
        $this->iteratorAggregate = new TypedIterableAggregate($iterator, $getType);
    }

    /**
     * @return Generator<TKey, T>
     */
    public function getIterator(): Generator
    {
        return $this->iteratorAggregate->getIterator();
    }
}
