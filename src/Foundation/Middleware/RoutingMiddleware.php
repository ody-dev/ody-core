<?php
declare(strict_types=1);

namespace Ody\Core\Foundation\Middleware;

use Ody\Core\Exceptions\HttpMethodNotAllowedException;
use Ody\Core\Exceptions\HttpNotFoundException;
use Ody\Core\Foundation\Interfaces\RouteParserInterface;
use Ody\Core\Foundation\Interfaces\RouteResolverInterface;
use Ody\Core\Foundation\Routing\RouteContext;
use Ody\Core\Foundation\Routing\RoutingResults;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use RuntimeException;

class RoutingMiddleware implements MiddlewareInterface
{
    protected RouteResolverInterface $routeResolver;

    protected RouteParserInterface $routeParser;

    public function __construct(RouteResolverInterface $routeResolver, RouteParserInterface $routeParser)
    {
        $this->routeResolver = $routeResolver;
        $this->routeParser = $routeParser;
    }

    /**
     * @throws HttpNotFoundException
     * @throws HttpMethodNotAllowedException
     * @throws RuntimeException
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $request = $this->performRouting($request);
        return $handler->handle($request);
    }

    /**
     * Perform routing
     *
     * @param  ServerRequestInterface $request PSR7 Server Request
     *
     * @throws HttpNotFoundException
     * @throws HttpMethodNotAllowedException
     * @throws RuntimeException
     */
    public function performRouting(ServerRequestInterface $request): ServerRequestInterface
    {
        $request = $request->withAttribute(RouteContext::ROUTE_PARSER, $this->routeParser);

        $routingResults = $this->resolveRoutingResultsFromRequest($request);
        $routeStatus = $routingResults->getRouteStatus();

        $request = $request->withAttribute(RouteContext::ROUTING_RESULTS, $routingResults);

        switch ($routeStatus) {
            case RoutingResults::FOUND:
                $routeArguments = $routingResults->getRouteArguments();
                $routeIdentifier = $routingResults->getRouteIdentifier() ?? '';
                $route = $this->routeResolver
                    ->resolveRoute($routeIdentifier)
                    ->prepare($routeArguments);
                return $request->withAttribute(RouteContext::ROUTE, $route);

            case RoutingResults::NOT_FOUND:
                throw new HttpNotFoundException($request);

            case RoutingResults::METHOD_NOT_ALLOWED:
                $exception = new HttpMethodNotAllowedException($request);
                $exception->setAllowedMethods($routingResults->getAllowedMethods());
                throw $exception;

            default:
                throw new RuntimeException('An unexpected error occurred while performing routing.');
        }
    }

    /**
     * Resolves the route from the given request
     */
    protected function resolveRoutingResultsFromRequest(ServerRequestInterface $request): RoutingResults
    {
        return $this->routeResolver->computeRoutingResults(
            $request->getUri()->getPath(),
            $request->getMethod()
        );
    }
}
