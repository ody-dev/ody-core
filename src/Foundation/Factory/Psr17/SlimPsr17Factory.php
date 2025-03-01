<?php
declare(strict_types=1);

namespace Ody\Core\Foundation\Factory\Psr17;

class SlimPsr17Factory extends Psr17Factory
{
    protected static string $responseFactoryClass = 'Ody\Core\Psr7\Factory\ResponseFactory';
    protected static string $streamFactoryClass = 'Ody\Core\Psr7\Factory\StreamFactory';
    protected static string $serverRequestCreatorClass = 'Ody\Core\Psr7\Factory\ServerRequestFactory';
    protected static string $serverRequestCreatorMethod = 'createFromGlobals';
}
