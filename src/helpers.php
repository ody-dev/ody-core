<?php
declare(strict_types=1);

use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;
use Ody\Core\Config\Config;
use Ody\Core\Http\Request;
use Ody\Swoole\ServerState;

if (! function_exists('app')) {
    /**
     * @throws DependencyException
     * @throws NotFoundException
     */
    function app($abstract = null, array $parameters = [])
    {
        if (is_null($abstract)) {
            return new Container();
        }

        return (new Container())->make($abstract, $parameters);
    }
}

if (! function_exists('resolve')) {
    function resolve(string $name = null, array $parameters = []) : mixed
    {
        return app($name, $parameters);
    }
}

if (! function_exists('app_path')) {
    function app_path(string $path = null): string
    {
        return base_path("App/$path");
    }
}


if (! function_exists('basePath')) {
    function base_path(string $path = null): string
    {
        /** @psalm-suppress UndefinedConstant */
        return realpath(PROJECT_PATH) . "/$path";
    }
}

if (! function_exists('configPath')) {
    function configPath(string $path = null): string
    {
        return base_path("config/$path");
    }
}

if (! function_exists('storagePath')) {
    function storagePath(string $path = null): string
    {
        return base_path("storage/$path");
    }
}

if (! function_exists('languagePath')) {
    function languagePath(string $path = null): string
    {
        return base_path("language/$path");
    }
}

if (! function_exists('databasePath')) {
    function databasePath(string $path = null): string
    {
        return base_path("database/$path");
    }
}

if (! function_exists('config')) {
    function config(string $key, mixed $default = null): mixed
    {
        return Config::getInstance()->get($key , $default);
    }
}

if (! function_exists('request')) {
    function request(): Request
    {
        return Request::getInstance();
    }
}

if (!function_exists('dd'))
{
    function dd()
    {
        array_map(function ($content) {
            echo "<pre>";
            var_dump($content);
            echo "</pre>";
            echo "<hr>";
        }, func_get_args());

        die;
    }
}

if (!function_exists('throw_when'))
{
    function throw_when(bool $fails, string $message, string $exception = Exception::class): void
    {
        if (!$fails) return;

        throw new $exception($message);
    }
}

if (!function_exists('routes_path'))
{
    function routes_path($path = ''): string
    {
        return base_path("routes/{$path}");
    }
}

//if (! function_exists('response')) {
//    function response(): Response
//    {
//        return Response::getInstance();
//    }
//}
//
//if (! function_exists('auth')) {
//    function auth(): Auth
//    {
//        return Auth::getInstance();
//    }
//}
//
//if (! function_exists('elasticsearch')) {
//    function elasticsearch(): Client
//    {
//        return Elasticsearch::getInstance();
//    }
//}
//
//if (! function_exists('redis')) {
//    function redis(): \Redis
//    {
//        return Redis::getInstance();
//    }
//}
//
//if (! function_exists('mail')) {
//    function mail(): Mail
//    {
//        return Mail::getInstance();
//    }
//}
//
//if (! function_exists('cache')) {
//    function cache(): Cache
//    {
//        return Cache::getInstance();
//    }
//}
//
//if (! function_exists('validation')) {
//    function validation(): Validation
//    {
//        return Validation::getInstance();
//    }
//}

if (!function_exists('env')) {
    function env(string $key, mixed $default = null): string|bool|null
    {
        $value = getenv($key);

        if ($value === false) {
            return $default;
        }

        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;
            case 'false':
            case '(false)':
                return false;
            case 'empty':
            case '(empty)':
                return '';
            case 'null':
            case '(null)':
                return null;
        }

        if (($valueLength = strlen($value)) > 1 && $value[0] === '"' && $value[$valueLength - 1] === '"') {
            return substr($value, 1, -1);
        }

        return $value;
    }
}
