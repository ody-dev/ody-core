<?php

namespace Ody\Core\Foundation\Loaders;

use Ody\Core\Foundation\Kernel;
use Ody\Core\Foundation\Middleware\BodyParsingMiddleware;

class LoadHttpMiddleware extends Bootstrapper
{
    public function boot()
    {
        $kernel = $this->app->resolve(Kernel::class);

        $this->app->getContainer()->set('middleware.kernel', fn () => [
            'global' => $kernel->middleware,
            'api' => $kernel->middlewareGroups['api'],
            'web' => $kernel->middlewareGroups['web']
        ]);

        $middleware = [
            ...$kernel->middleware,
            ...$kernel->middlewareGroups['api'],
            ...$kernel->middlewareGroups['web']
        ];

        foreach ($middleware as $mw) {
            $this->app->add(new $mw());
        }

        $this->app->add(new BodyParsingMiddleware());


//        $kernel = $this->app->resolve(Kernel::class);
//
//        $middleware = [
//            ...$kernel->middleware,
//            ...$kernel->middlewareGroups['api'],
//            ...$kernel->middlewareGroups['web']
//        ];
//
//        collect($middleware)
//            ->filter(fn ($guard) => class_exists($guard))
//            ->each(fn ($guard) => $this->app->bind($guard, new $guard));
//
//        $this->app->bind('middleware', fn () => [
//            'global' => $kernel->middleware,
//            'api' => $kernel->middlewareGroups['api'],
//            'web' => $kernel->middlewareGroups['web']
//        ]);
    }
}