<?php

namespace Ody\Core\Foundation\Loaders;

use Ody\Core\Foundation\Middleware\WhoopsMiddleware;

class DebugPageLoader extends Bootstrapper
{
    public function boot()
    {
        if (env('APP_DEBUG', false)) {
            $this->app->add(new WhoopsMiddleware);
        }
    }
}