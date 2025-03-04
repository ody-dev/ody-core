<?php

declare(strict_types=1);

namespace Ody\Core\Support\Iterators;

use ArrayIterator;
use Generator;
use Iterator;
use Ody\Core\Support\Iterators\Contract\PausableIteratorAggregateInterface;

/**
 * @template TKey
 * @template T
 *
 * @implements PausableIteratorAggregateInterface<TKey, T>
 */
final class PausableIteratorAggregate implements PausableIteratorAggregateInterface
{
    /**
     * @var Iterator<int, array{0:TKey, 1:T}>
     */
    private Iterator $iterator;

    /**
     * @var PackIterableAggregate<TKey, T>
     */
    private PackIterableAggregate $iteratorAggregate;

    /**
     * @param Iterator<TKey, T> $iterator
     */
    public function __construct(Iterator $iterator)
    {
        $this->iteratorAggregate = new PackIterableAggregate(new CachingIteratorAggregate($iterator));
        $this->iterator = new ArrayIterator();
    }

    /**
     * @return Generator<TKey, T>
     */
    public function getIterator(): Generator
    {
        $this->iterator = $this->iteratorAggregate->getIterator();

        foreach ($this->iterator as [$key, $value]) {
            yield $key => $value;
        }
    }

    /**
     * @return Generator<TKey, T>
     */
    public function rest(): Generator
    {
        for ($this->iterator->next(); $this->iterator->valid(); $this->iterator->next()) {
            [$key, $current] = $this->iterator->current();

            yield $key => $current;
        }
    }
}
