<?php

declare(strict_types=1);

namespace Ody\Core\Support\Iterators;

use Generator;
use IteratorAggregate;

/**
 * @implements IteratorAggregate<int, string>
 */
final class StringIteratorAggregate implements IteratorAggregate
{
    public function __construct(private string $data, private string $delimiter = '') {}

    /**
     * @return Generator<int, string>
     */
    public function getIterator(): Generator
    {
        $input = $this->data;
        $delimiter = $this->delimiter;
        $offset = 0;

        while (
            mb_strlen($input) > $offset
            && false !== $nextOffset = '' !== $delimiter ? mb_strpos($input, $delimiter, $offset) : 1 + $offset
        ) {
            yield mb_substr($input, $offset, $nextOffset - $offset);

            $offset = $nextOffset + mb_strlen($delimiter);
        }

        if ('' !== $delimiter) {
            yield mb_substr($input, $offset);
        }
    }
}
