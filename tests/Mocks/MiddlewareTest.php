<?php
declare(strict_types=1);

namespace Ody\Core\Tests\Mocks;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Ody\Core\Tests\Providers\PSR7ObjectProvider;

class MiddlewareTest implements MiddlewareInterface
{
    public static $CalledCount = 0;

    /**
     * {@inheritdoc}
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        static::$CalledCount++;

        $psr7ObjectProvider = new PSR7ObjectProvider();
        $responseFactory = $psr7ObjectProvider->getResponseFactory();

        $response = $responseFactory
            ->createResponse()
            ->withHeader('Content-Type', 'text/plain');
        $calledCount = static::$CalledCount;
        $response->getBody()->write("{$calledCount}");

        return $response;
    }
}
