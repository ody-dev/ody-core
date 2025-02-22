<?php
declare(strict_types=1);

namespace Ody\Core\Interfaces;

use Ody\Core\Routing\RoutingResults;

interface DispatcherInterface
{
    /**
     * Get routing results for a given request method and uri
     */
    public function dispatch(string $method, string $uri): RoutingResults;

    /**
     * Get allowed methods for a given uri
     *
     * @return string[]
     */
    public function getAllowedMethods(string $uri): array;
}
