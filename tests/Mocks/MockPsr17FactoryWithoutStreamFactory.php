<?php
declare(strict_types=1);

namespace Ody\Core\Tests\Mocks;

use Slim\Factory\Psr17\Psr17Factory;

class MockPsr17FactoryWithoutStreamFactory extends Psr17Factory
{
    protected static string $responseFactoryClass = 'Slim\Psr7\Factory\ResponseFactory';
    protected static string $streamFactoryClass = '';
    protected static string $serverRequestCreatorClass = '';
    protected static string $serverRequestCreatorMethod = '';
}
