<?php

declare(strict_types=1);
namespace Ody\Core\Contracts;

/**
 * @template TKey of array-key
 * @template TValue
 */
interface Arrayable
{
    /**
     * @return array<TKey, TValue>
     */
    public function toArray(): array;
}
