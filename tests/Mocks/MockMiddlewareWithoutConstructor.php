<?php
declare(strict_types=1);

namespace Ody\Core\Tests\Mocks;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class MockMiddlewareWithoutConstructor implements MiddlewareInterface
{
    public static $CalledCount = 0;

    /**
     * @param ServerRequestInterface  $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $appendToOutput = $request->getAttribute('appendToOutput');
        if ($appendToOutput !== null) {
            $appendToOutput('Hello World');
        }

        static::$CalledCount++;

        return $handler->handle($request);
    }
}
