<?php
declare(strict_types=1);

namespace Ody\Core\Foundation\Interfaces;

use Ody\Core\Foundation\Routing\RoutingResults;

interface RouteResolverInterface
{
    /**
     * @param string $uri Should be ServerRequestInterface::getUri()->getPath()
     */
    public function computeRoutingResults(string $uri, string $method): RoutingResults;

    public function resolveRoute(string $identifier): RouteInterface;
}
