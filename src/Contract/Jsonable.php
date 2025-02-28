<?php

declare(strict_types=1);
namespace Ody\Core\Contract;

use Stringable;

interface Jsonable extends Stringable
{
    public function __toString(): string;
}
