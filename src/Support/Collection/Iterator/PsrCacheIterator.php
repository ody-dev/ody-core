<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Iterator;

use Iterator;
use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;
use ReturnTypeWillChange;

/**
 * @internal
 *
 * @template TKey
 * @template T
 *
 * @implements Iterator<TKey, T>
 */
final class PsrCacheIterator implements Iterator
{
    private int $key = 0;

    /**
     * @param Iterator<TKey, T> $iterator
     */
    public function __construct(private Iterator $iterator, private CacheItemPoolInterface $cache) {}

    /**
     * @return T
     */
    #[ReturnTypeWillChange]
    public function current()
    {
        /** @var array{TKey, T} $data */
        $data = $this->getTupleFromCache($this->key)->get();

        return $data[1];
    }

    /**
     * @return TKey
     */
    #[ReturnTypeWillChange]
    public function key()
    {
        /** @var array{TKey, T} $data */
        $data = $this->getTupleFromCache($this->key)->get();

        return $data[0];
    }

    public function next(): void
    {
        // This is mostly for iterator_count().
        $this->getTupleFromCache($this->key++);

        $this->iterator->next();
    }

    public function rewind(): void
    {
        // No call to $this->iterator->rewind() because we do not know if the inner
        // iterator can be rewinded or not.
        $this->key = 0;
    }

    public function valid(): bool
    {
        return $this->iterator->valid() || $this->cache->hasItem((string) $this->key);
    }

    private function getTupleFromCache(int $key): CacheItemInterface
    {
        $item = $this->cache->getItem((string) $key);

        if (false === $item->isHit()) {
            $item->set([
                $this->iterator->key(),
                $this->iterator->current(),
            ]);

            $this->cache->save($item);
        }

        return $item;
    }
}
