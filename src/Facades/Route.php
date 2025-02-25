<?php

namespace Ody\Core\Facades;

use Ody\Core\Kernel;

final class Route extends Facade
{
    /**
     * Overriding Facades::self() to set Ody\Core\Kernel instance is in order to tell
     * Facades to proxy it.
     * These facades are same to Kernel. Because of the $container['router']
     * (Instance of \Ody\Core\Interfaces\RouterInterface) did not support many
     * function like $app->get() and so on.  So I repeat it and it is named
     * "Route".
     * @return Kernel
     */
    public static function self(): Kernel
    {
        return self::$app;
    }
}