<?php

namespace Ody\Core\Foundation;

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
        Loaders\LoadDebugPage::class,
        Loaders\LoadHttpMiddleware::class,
        Loaders\LoadServiceProviders::class,
    ];
}