<?php
declare(strict_types=1);

namespace Ody\Core\Handlers\Strategies;

use Invoker\Exception\InvocationException;
use Invoker\Exception\NotCallableException;
use Invoker\Exception\NotEnoughParametersException;
use Invoker\InvokerInterface;
use Ody\Core\Interfaces\InvocationStrategyInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ControllerInvoker implements InvocationStrategyInterface
{
    /** @var InvokerInterface */
    private InvokerInterface $invoker;

    public function __construct(InvokerInterface $invoker)
    {
        $this->invoker = $invoker;
    }

    /**
     * Invoke a route callable.
     *
     * @param callable $callable The callable to invoke using the strategy.
     * @param ServerRequestInterface $request The request object.
     * @param ResponseInterface $response The response object.
     * @param array $routeArguments The route's placeholder arguments
     * @return ResponseInterface The response from the callable.
     * @throws InvocationException
     * @throws NotCallableException
     * @throws NotEnoughParametersException
     */
    public function __invoke(
        callable $callable,
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $routeArguments
    ): ResponseInterface {
        // Inject the request and response by parameter name
        $parameters = [
            'request'  => self::injectRouteArguments($request, $routeArguments),
            'response' => $response,
        ];
        // Inject the route arguments by name
        $parameters += $routeArguments;
        // Inject the attributes defined on the request
        $parameters += $request->getAttributes();

        return $this->invoker->call($callable, $parameters);
    }

    private static function injectRouteArguments(ServerRequestInterface $request, array $routeArguments): ServerRequestInterface
    {
        $requestWithArgs = $request;
        foreach ($routeArguments as $key => $value) {
            $requestWithArgs = $requestWithArgs->withAttribute($key, $value);
        }
        return $requestWithArgs;
    }
}
