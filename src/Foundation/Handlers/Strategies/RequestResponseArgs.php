<?php
declare(strict_types=1);

namespace Ody\Core\Foundation\Handlers\Strategies;

use Ody\Core\Foundation\Interfaces\InvocationStrategyInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use function array_values;

/**
 * Route callback strategy with route parameters as individual arguments.
 * @api
 */
class RequestResponseArgs implements InvocationStrategyInterface
{
    /**
     * Invoke a route callable with request, response and all route parameters
     * as individual arguments.
     *
     * @param array<string, string>  $routeArguments
     */
    public function __invoke(
        callable $callable,
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $routeArguments
    ): ResponseInterface {
        return $callable($request, $response, ...array_values($routeArguments));
    }
}
