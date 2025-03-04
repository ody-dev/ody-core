<?php

declare(strict_types=1);

namespace Ody\Core\Support\Iterators\Contract;

use Generator;
use IteratorAggregate;

/**
 * @template TKey
 * @template T
 *
 * @extends IteratorAggregate<TKey, T>
 */
interface PausableIteratorAggregateInterface extends IteratorAggregate
{
    /**
     * @return Generator<TKey, T>
     */
    public function rest(): Generator;
}
