<?php
declare(strict_types=1);

namespace Ody\Core\Foundation\Factory\Psr17;

use Closure;
use Ody\Core\Foundation\Interfaces\ServerRequestCreatorInterface;
use Psr\Http\Message\ServerRequestInterface;

class ServerRequestCreator implements ServerRequestCreatorInterface
{
    /**
     * @var object|string
     */
    protected $serverRequestCreator;

    protected string $serverRequestCreatorMethod;

    /**
     * @param object|string $serverRequestCreator
     */
    public function __construct($serverRequestCreator, string $serverRequestCreatorMethod)
    {
        $this->serverRequestCreator = $serverRequestCreator;
        $this->serverRequestCreatorMethod = $serverRequestCreatorMethod;
    }

    /**
     * {@inheritdoc}
     */
    public function createServerRequestFromGlobals(): ServerRequestInterface
    {
        /** @var callable $callable */
        $callable = [$this->serverRequestCreator, $this->serverRequestCreatorMethod];
        return (Closure::fromCallable($callable))();
    }
}
