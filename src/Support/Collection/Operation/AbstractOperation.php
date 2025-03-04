<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Operation;

use Closure;
use Ody\Core\Support\Collection\Contract\Operation;

/**
 * @immutable
 */
abstract class AbstractOperation implements Operation
{
    final public function __construct() {}

    public static function of(): Closure
    {
        return (new static())->__invoke();
    }
}
