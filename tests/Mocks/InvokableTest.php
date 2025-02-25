<?php
declare(strict_types=1);

namespace Ody\Core\Tests\Mocks;

class InvokableTest
{
    public static $CalledCount = 0;

    public function __invoke()
    {
        return static::$CalledCount++;
    }
}
