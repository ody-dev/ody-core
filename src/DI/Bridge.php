<?php
declare(strict_types=1);

namespace Ody\Core\DI;

use DI\Container;
use Invoker\CallableResolver as InvokerCallableResolver;
use Invoker\Invoker;
use Invoker\ParameterResolver\AssociativeArrayResolver;
use Invoker\ParameterResolver\Container\TypeHintContainerResolver;
use Invoker\ParameterResolver\DefaultValueResolver;
use Invoker\ParameterResolver\ResolverChain;
use Ody\Core\App;
use Ody\Core\Factory\AppFactory;
use Ody\Core\Interfaces\CallableResolverInterface;
use Psr\Container\ContainerInterface;

/**
 * To use this, replace `Ody\Core\Factory\AppFactory::create()`
 * with `Ody\Core\DI\Bridge::create()`.
 */
class Bridge
{
    public static function create(?ContainerInterface $container = null): App
    {
        $container = $container ?: new Container;

        $callableResolver = new InvokerCallableResolver($container);

        $container->set(CallableResolverInterface::class, new CallableResolver($callableResolver));
        $app = AppFactory::createFromContainer($container);

        $container->set(App::class, $app);

        $controllerInvoker = static::createControllerInvoker($container);
        $app->getRouteCollector()->setDefaultInvocationStrategy($controllerInvoker);

        return $app;
    }

    private static function createControllerInvoker(ContainerInterface $container): ControllerInvoker
    {
        $resolvers = [
            // Inject parameters by name first
            new AssociativeArrayResolver,
            // Then inject services by type-hints for those that weren't resolved
            new TypeHintContainerResolver($container),
            // Then fall back on parameters default values for optional route parameters
            new DefaultValueResolver,
        ];

        $invoker = new Invoker(new ResolverChain($resolvers), $container);

        return new ControllerInvoker($invoker);
    }
}
