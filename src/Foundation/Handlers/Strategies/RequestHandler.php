<?php
declare(strict_types=1);

namespace Ody\Core\Foundation\Handlers\Strategies;

use Ody\Core\Foundation\Interfaces\RequestHandlerInvocationStrategyInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * PSR-15 RequestHandler invocation strategy
 */
class RequestHandler implements RequestHandlerInvocationStrategyInterface
{
    protected bool $appendRouteArgumentsToRequestAttributes;

    public function __construct(bool $appendRouteArgumentsToRequestAttributes = false)
    {
        $this->appendRouteArgumentsToRequestAttributes = $appendRouteArgumentsToRequestAttributes;
    }

    /**
     * Invoke a route callable that implements RequestHandlerInterface
     *
     * @param array<string, string>  $routeArguments
     */
    public function __invoke(
        callable $callable,
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $routeArguments
    ): ResponseInterface {
        if ($this->appendRouteArgumentsToRequestAttributes) {
            foreach ($routeArguments as $k => $v) {
                $request = $request->withAttribute($k, $v);
            }
        }

        return $callable($request);
    }
}
