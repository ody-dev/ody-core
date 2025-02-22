<?php

namespace Ody\Core\Server;

use Ody\Core\App;
use Ody\Core\Factory\ServerRequestCreatorFactory;
use Ody\Core\ResponseEmitter;

class PhpServer
{
    public function start(App $app)
    {
        $serverRequestCreator = ServerRequestCreatorFactory::create();
        $request = $serverRequestCreator->createServerRequestFromGlobals();

        $response = $app->handle($request);
        $responseEmitter = new ResponseEmitter();
        $responseEmitter->emit($response);
    }
}