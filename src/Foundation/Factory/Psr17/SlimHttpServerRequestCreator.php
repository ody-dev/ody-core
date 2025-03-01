<?php
declare(strict_types=1);

namespace Ody\Core\Foundation\Factory\Psr17;

use Ody\Core\Foundation\Interfaces\ServerRequestCreatorInterface;
use Psr\Http\Message\ServerRequestInterface;
use RuntimeException;
use function class_exists;

class SlimHttpServerRequestCreator implements ServerRequestCreatorInterface
{
    protected ServerRequestCreatorInterface $serverRequestCreator;

    protected static string $serverRequestDecoratorClass = 'Ody\Core\Http\ServerRequest';

    public function __construct(ServerRequestCreatorInterface $serverRequestCreator)
    {
        $this->serverRequestCreator = $serverRequestCreator;
    }

    /**
     * {@inheritdoc}
     */
    public function createServerRequestFromGlobals(): ServerRequestInterface
    {
        if (!static::isServerRequestDecoratorAvailable()) {
            throw new RuntimeException('The Slim-Http ServerRequest decorator is not available.');
        }

        $request = $this->serverRequestCreator->createServerRequestFromGlobals();

        if (
            !((
                $decoratedServerRequest = new static::$serverRequestDecoratorClass($request)
                ) instanceof ServerRequestInterface)
        ) {
            throw new RuntimeException(get_called_class() . ' could not instantiate a decorated server request.');
        }

        return $decoratedServerRequest;
    }

    public static function isServerRequestDecoratorAvailable(): bool
    {
        return class_exists(static::$serverRequestDecoratorClass);
    }
}
