<?php
declare(strict_types=1);

namespace Ody\Core\Tests\Mocks;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Interfaces\RequestHandlerInvocationStrategyInterface;

class MockCustomRequestHandlerInvocationStrategy implements RequestHandlerInvocationStrategyInterface
{
    public static $CalledCount = 0;

    public function __invoke(
        callable $callable,
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $routeArguments
    ): ResponseInterface {
        self::$CalledCount += 1;
        return $callable($request);
    }
}
