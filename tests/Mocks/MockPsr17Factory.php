<?php
declare(strict_types=1);

namespace Ody\Core\Tests\Mocks;

use Slim\Factory\Psr17\Psr17Factory;

class MockPsr17Factory extends Psr17Factory
{
    protected static string $responseFactoryClass = '';
    protected static string $streamFactoryClass = '';
    protected static string $serverRequestCreatorClass = '';
    protected static string $serverRequestCreatorMethod = '';
}
