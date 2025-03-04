<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Operation;

use Closure;
use Generator;

/**
 * @immutable
 *
 * @template TKey
 * @template T
 */
final class Unwrap extends AbstractOperation
{
    /**
     * @return Closure(iterable<TKey, T>): Generator<mixed, mixed>
     */
    public function __invoke(): Closure
    {
        /** @var Closure(iterable<TKey, T>): Generator<mixed, mixed> $flatten */
        $flatten = (new Flatten())()(1);

        // Point free style.
        return $flatten;
    }
}
