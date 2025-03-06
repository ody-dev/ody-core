<?php

namespace Ody\Core\Support;

use Illuminate\Support\Str;
use Ody\Core\Foundation\App;

class Route
{
    public static App $app;

    public static function setup(App &$app): App
    {
        self::$app = $app;

        return $app;
    }

    public static function __callStatic($verb, $parameters)
    {
        $app = self::$app;

        [$route, $action] = $parameters;

        self::validation($route, $verb, $action);

        return is_callable($action)
            ? $app->$verb($route, $action)
            : $app->$verb($route, self::resolveViaController($action));
    }

    public static function resolveViaController($action)
    {
        $controller = Str::before($action, '@');
        $method = Str::after($action, '@');

        throw_when(!isset($controller), "Unresolvable action, wasn't able to find controller for {$action}");

        return [$controller, $method];
    }

    protected static function validation($route, $verb, $action)
    {
        $exception = "Unresolvable Route Callback/Controller action";
        $context = json_encode(compact('route', 'action', 'verb'));
        $fails = !((is_callable($action)) or (is_string($action) and Str::is("*@*", $action)));

        throw_when($fails, $exception . $context);
    }
}