<?php

namespace Ody\Core\Foundation\Bootstrappers;

class LoadDebugPage extends Bootstrapper
{
    public function boot()
    {
        if (env('APP_DEBUG', false)) {
//            $this->app->add(new WhoopsMiddleware);
        }
    }
}