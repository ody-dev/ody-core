<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Contract;

use Closure;

/**
 * @immutable
 */
interface Operation
{
    public function __invoke(): Closure;

    public static function of(): Closure;
}
