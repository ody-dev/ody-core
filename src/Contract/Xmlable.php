<?php

declare(strict_types=1);
namespace Ody\Core\Contract;

use Stringable;

interface Xmlable extends Stringable
{
    public function __toString(): string;
}
