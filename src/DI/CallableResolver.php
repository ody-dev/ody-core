<?php
declare(strict_types=1);

namespace Ody\Core\DI;

use Invoker\Exception\NotCallableException;
use Ody\Core\Foundation\Interfaces\AdvancedCallableResolverInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Resolve middleware and route callables using PHP-DI.
 */
class CallableResolver implements AdvancedCallableResolverInterface
{
    /** @var \Invoker\CallableResolver */
    private $callableResolver;

    public function __construct(\Invoker\CallableResolver $callableResolver)
    {
        $this->callableResolver = $callableResolver;
    }

    /**
     * {@inheritdoc}
     */
    public function resolve($toResolve): callable
    {
        return $this->callableResolver->resolve($this->translateNotation($toResolve));
    }

    /**
     * {@inheritdoc}
     */
    public function resolveRoute($toResolve): callable
    {
        return $this->resolvePossibleSignature($toResolve, 'handle', RequestHandlerInterface::class);
    }

    /**
     * {@inheritdoc}
     */
    public function resolveMiddleware($toResolve): callable
    {
        return $this->resolvePossibleSignature($toResolve, 'process', MiddlewareInterface::class);
    }

    /**
     * Translate string callable notation ('nameOrKey:method') to PHP-DI notation ('nameOrKey::method').
     *
     * @param callable|string $toResolve
     */
    private function translateNotation(string|callable $toResolve): callable|string
    {
        if (is_string($toResolve) && preg_match(\Ody\Core\Foundation\CallableResolver::$callablePattern, $toResolve)) {
            $toResolve = str_replace(':', '::', $toResolve);
        }

        return $toResolve;
    }

    /**
     * @param string|callable|array $toResolve
     * @param string $method
     * @param string $typeName
     * @return callable
     * @throws NotCallableException
     * @throws \ReflectionException
     */
    private function resolvePossibleSignature(callable|array $toResolve, string $method, string $typeName): callable
    {
        return $this->callableResolver->resolve($toResolve);
    }
}
