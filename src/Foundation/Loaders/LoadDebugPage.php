<?php

namespace Ody\Core\Foundation\Loaders;

class LoadDebugPage extends Bootstrapper
{
    public function boot()
    {
        if (env('APP_DEBUG', false)) {
//            $this->app->add(new WhoopsMiddleware);
        }
    }
}