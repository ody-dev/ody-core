<?php
declare(strict_types=1);

namespace Ody\Core\Foundation\Interfaces;

use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/** @api */
interface MiddlewareDispatcherInterface extends RequestHandlerInterface
{
    /**
     * Add a new middleware to the stack
     *
     * Middleware are organized as a stack. That means middleware
     * that have been added before will be executed after the newly
     * added one (last in, first out).
     *
     * @param MiddlewareInterface|string|callable $middleware
     */
    public function add($middleware): self;

    /**
     * Add a new middleware to the stack
     *
     * Middleware are organized as a stack. That means middleware
     * that have been added before will be executed after the newly
     * added one (last in, first out).
     */
    public function addMiddleware(MiddlewareInterface $middleware): self;

    /**
     * Seed the middleware stack with the inner request handler
     */
    public function seedMiddlewareStack(RequestHandlerInterface $kernel): void;
}
