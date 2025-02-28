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
        Bootstrappers\LoadEnvironmentVariables::class,
        Bootstrappers\LoadDebugPage::class,
        Bootstrappers\LoadHttpMiddleware::class,
        Bootstrappers\LoadServiceProviders::class,
    ];
}