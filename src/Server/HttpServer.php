<?php

namespace Ody\Core\Server;

use DI\Container;
use Ody\Core\Foundation\App;
use Ody\Core\Foundation\Bootstrap;
use Ody\Core\Foundation\Http\Request;
use Ody\HttpServer\RequestCallback;
use Ody\HttpServer\Server;
use Ody\Swoole\Coroutine\ContextManager;
use Swoole\Coroutine;
use Swoole\Http\Request as SwRequest;
use Swoole\Http\Response as SwResponse;
use Ody\Core\Server\Concerns\ServerCallbacks;

class HttpServer
{
    use ServerCallbacks;

    private static App $app;

    /**
     * @param Server $server
     * @return void
     */
    public function start(Server $server): void
    {
        static::$app = Bootstrap::init(
            App::create(new Container())
        );

        static::$app->bind(Server::class, $server);

        $server->start();
    }

    /**
     * @param SwRequest $request
     * @param SwResponse $response
     * @return void
     */
    public static function onRequest(SwRequest $request, SwResponse $response): void
    {
        Coroutine::create(function() use ($request, $response) {
            static::setContext($request);

            (new RequestCallback(
                static::$app
            ))->handle($request, $response);
        });
    }

    /**
     * @param SwRequest $request
     * @return void
     */
    private static function setContext(SwRequest $request): void
    {
        ContextManager::set('_GET', (array)$request->get);
        ContextManager::set('_GET', (array)$request->get);
        ContextManager::set('_POST', (array)$request->post);
        ContextManager::set('_FILES', (array)$request->files);
        ContextManager::set('_COOKIE', (array)$request->cookie);
        ContextManager::set('_SERVER', (array)$request->server);
        ContextManager::set('request', Request::getInstance());
    }
}