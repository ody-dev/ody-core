<?php
declare(strict_types=1);

namespace Ody\Core\Foundation\Factory\Psr17;

use Ody\Core\Foundation\Interfaces\Psr17FactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use RuntimeException;
use function class_exists;
use function get_called_class;

abstract class Psr17Factory implements Psr17FactoryInterface
{
    protected static string $responseFactoryClass;

    protected static string $streamFactoryClass;

    protected static string $serverRequestCreatorClass;

    protected static string $serverRequestCreatorMethod;

    /**
     * {@inheritdoc}
     */
    public static function getResponseFactory(): ResponseFactoryInterface
    {
        if (
            !static::isResponseFactoryAvailable()
            || !(($responseFactory = new static::$responseFactoryClass()) instanceof ResponseFactoryInterface)
        ) {
            throw new RuntimeException(get_called_class() . ' could not instantiate a response factory.');
        }

        return $responseFactory;
    }

    /**
     * {@inheritdoc}
     */
    public static function getStreamFactory(): StreamFactoryInterface
    {
        if (
            !static::isStreamFactoryAvailable()
            || !(($streamFactory = new static::$streamFactoryClass()) instanceof StreamFactoryInterface)
        ) {
            throw new RuntimeException(get_called_class() . ' could not instantiate a stream factory.');
        }

        return $streamFactory;
    }

    /**
     * {@inheritdoc}
     */
    public static function getServerRequestCreator(): ServerRequestCreator
    {
        if (!static::isServerRequestCreatorAvailable()) {
            throw new RuntimeException(get_called_class() . ' could not instantiate a server request creator.');
        }

        return new ServerRequestCreator(static::$serverRequestCreatorClass, static::$serverRequestCreatorMethod);
    }

    /**
     * {@inheritdoc}
     */
    public static function isResponseFactoryAvailable(): bool
    {
        return static::$responseFactoryClass && class_exists(static::$responseFactoryClass);
    }

    /**
     * {@inheritdoc}
     */
    public static function isStreamFactoryAvailable(): bool
    {
        return static::$streamFactoryClass && class_exists(static::$streamFactoryClass);
    }

    /**
     * {@inheritdoc}
     */
    public static function isServerRequestCreatorAvailable(): bool
    {
        return (
            static::$serverRequestCreatorClass
            && static::$serverRequestCreatorMethod
            && class_exists(static::$serverRequestCreatorClass)
        );
    }
}
