<?php

namespace Ody\Core\Server;

use Ody\Core\Foundation\App;
use Ody\Core\Foundation\Factory\ServerRequestCreatorFactory;
use Ody\Core\Foundation\ResponseEmitter;

class PhpServer
{
    public static function init(App $app): void
    {
        $serverRequestCreator = ServerRequestCreatorFactory::create();
        $request = $serverRequestCreator->createServerRequestFromGlobals();

        $response = $app->handle($request);
        $responseEmitter = new ResponseEmitter();
        $responseEmitter->emit($response);
    }
}