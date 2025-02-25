<?php
declare(strict_types=1);

namespace Ody\Core\Tests\Mocks;

use Ody\Core\Tests\Providers\PSR7ObjectProvider;

class CallableTest
{
    public static $CalledCount = 0;

    public static $CalledContainer = null;

    public function __construct($container = null)
    {
        static::$CalledContainer = $container;
    }

    public function toCall()
    {
        static::$CalledCount++;

        $psr7ObjectProvider = new PSR7ObjectProvider();
        return $psr7ObjectProvider->createResponse();
    }
}
