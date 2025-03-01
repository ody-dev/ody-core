<?php
declare(strict_types=1);

namespace Ody\Core\Foundation\Factory\Psr17;


class NyholmPsr17Factory extends Psr17Factory
{
    protected static string $responseFactoryClass = 'Nyholm\Psr7\Factory\Psr17Factory';
    protected static string $streamFactoryClass = 'Nyholm\Psr7\Factory\Psr17Factory';
    protected static string $serverRequestCreatorClass = 'Nyholm\Psr7Server\ServerRequestCreator';
    protected static string $serverRequestCreatorMethod = 'fromGlobals';

    /**
     * {@inheritdoc}
     */
    public static function getServerRequestCreator(): ServerRequestCreator
    {
        /*
         * Nyholm Psr17Factory implements all factories in one unified
         * factory which implements all the PSR-17 factory interfaces
         */
        $psr17Factory = new static::$responseFactoryClass();

        $serverRequestCreator = new static::$serverRequestCreatorClass(
            $psr17Factory,
            $psr17Factory,
            $psr17Factory,
            $psr17Factory
        );

        return new ServerRequestCreator($serverRequestCreator, static::$serverRequestCreatorMethod);
    }
}
