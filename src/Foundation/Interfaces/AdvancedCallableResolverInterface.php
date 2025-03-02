<?php
declare(strict_types=1);

namespace Ody\Core\Foundation\Interfaces;

interface AdvancedCallableResolverInterface extends CallableResolverInterface
{
    /**
     * Resolve $toResolve into a callable
     *
     * @param string|callable $toResolve
     */
    public function resolveRoute($toResolve): callable;

    /**
     * Resolve $toResolve into a callable
     *
     * @param string|callable $toResolve
     */
    public function resolveMiddleware($toResolve): callable;
}
