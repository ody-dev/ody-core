<?php

namespace Ody\Core\Foundation;

use Ody\Core\Foundation\Middleware\BodyParsingMiddleware;

class HttpKernel extends Kernel
{
    /**
     * Global middleware
     *
     * @var array
     */
    public array $middleware = [];

    public array $routeGroupMiddleware = [];

    public array $middlewareGroups = [
        'api' => [],
        'web' => []
    ];

    public array $bootstrap = [
        Loaders\LoadEnvironmentVariables::class,
        Loaders\DebugPageLoader::class,
        Loaders\LoadHttpMiddleware::class,
        Loaders\LoadServiceProviders::class,
    ];
}