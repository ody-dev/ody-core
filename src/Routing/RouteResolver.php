<?php
declare(strict_types=1);

namespace Ody\Core\Routing;

use Ody\Core\Interfaces\DispatcherInterface;
use Ody\Core\Interfaces\RouteCollectorInterface;
use Ody\Core\Interfaces\RouteResolverInterface;
use Ody\Core\Interfaces\RouteInterface;
use RuntimeException;

use function rawurldecode;

/**
 * RouteResolver instantiates the FastRoute dispatcher
 * and computes the routing results of a given URI and request method
 */
class RouteResolver implements RouteResolverInterface
{
    protected RouteCollectorInterface $routeCollector;

    private DispatcherInterface $dispatcher;

    public function __construct(RouteCollectorInterface $routeCollector, ?DispatcherInterface $dispatcher = null)
    {
        $this->routeCollector = $routeCollector;
        $this->dispatcher = $dispatcher ?? new Dispatcher($routeCollector);
    }

    /**
     * @param string $uri Should be $request->getUri()->getPath()
     */
    public function computeRoutingResults(string $uri, string $method): RoutingResults
    {
        $uri = rawurldecode($uri);
        if ($uri === '' || $uri[0] !== '/') {
            $uri = '/' . $uri;
        }
        return $this->dispatcher->dispatch($method, $uri);
    }

    /**
     * @throws RuntimeException
     */
    public function resolveRoute(string $identifier): RouteInterface
    {
        return $this->routeCollector->lookupRoute($identifier);
    }
}
