<?php
declare(strict_types=1);
namespace Ody\Core\Foundation;

use DI\Container;
use Invoker\CallableResolver as InvokerCallableResolver;
use Invoker\Invoker;
use Invoker\ParameterResolver\AssociativeArrayResolver;
use Invoker\ParameterResolver\Container\TypeHintContainerResolver;
use Invoker\ParameterResolver\DefaultValueResolver;
use Invoker\ParameterResolver\ResolverChain;
use Ody\Core\Env;
use Ody\Core\Foundation\Concerns\ContainerMethods;
use Ody\Core\Foundation\Factory\KernelFactory;
use Ody\Core\Foundation\Factory\ServerRequestCreatorFactory;
use Ody\Core\Foundation\Handlers\Strategies\ControllerInvoker;
use Ody\Core\Foundation\Interfaces\CallableResolverInterface;
use Ody\Core\Foundation\Interfaces\MiddlewareDispatcherInterface;
use Ody\Core\Foundation\Interfaces\RouteCollectorInterface;
use Ody\Core\Foundation\Interfaces\RouteResolverInterface;
use Ody\Core\Foundation\Middleware\BodyParsingMiddleware;
use Ody\Core\Foundation\Middleware\ErrorMiddleware;
use Ody\Core\Foundation\Middleware\RoutingMiddleware;
use Ody\Core\Foundation\Providers\ServiceProvider;
use Ody\Core\Foundation\Routing\RouteCollectorProxy;
use Ody\Core\Foundation\Routing\RouteResolver;
use Ody\Core\Foundation\Routing\RouteRunner;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Log\LoggerInterface;

/**
 * @api
 * @template TContainerInterface of (ContainerInterface|null)
 * @template-extends RouteCollectorProxy<TContainerInterface>
 */
class App extends RouteCollectorProxy implements RequestHandlerInterface
{
    use ContainerMethods;

    /**
     * Current version
     *
     * @var string
     */
    public const VERSION = '0.0.1';

    protected RouteResolverInterface $routeResolver;

    protected MiddlewareDispatcherInterface $middlewareDispatcher;

    /**
     * @param ResponseFactoryInterface $responseFactory
     * @param ContainerInterface|null $container
     * @param CallableResolverInterface|null $callableResolver
     * @param RouteCollectorInterface|null $routeCollector
     * @param RouteResolverInterface|null $routeResolver
     * @param MiddlewareDispatcherInterface|null $middlewareDispatcher
     */
    public function __construct(
        ResponseFactoryInterface $responseFactory,
        ?ContainerInterface $container = null,
        ?CallableResolverInterface $callableResolver = null,
        ?RouteCollectorInterface $routeCollector = null,
        ?RouteResolverInterface $routeResolver = null,
        ?MiddlewareDispatcherInterface $middlewareDispatcher = null
    ) {
        parent::__construct(
            $responseFactory,
            $callableResolver ?? new CallableResolver($container),
            $container,
            $routeCollector
        );

        $this->routeResolver = $routeResolver ?? new RouteResolver($this->routeCollector);
        $routeRunner = new RouteRunner($this->routeResolver, $this->routeCollector->getRouteParser(), $this);

        if (!$middlewareDispatcher) {
            $middlewareDispatcher = new MiddlewareDispatcher($routeRunner, $this->callableResolver, $container);
        } else {
            $middlewareDispatcher->seedMiddlewareStack($routeRunner);
        }

        $this->middlewareDispatcher = $middlewareDispatcher;
    }

    /**
     * Bridge DI
     *
     * @param ContainerInterface|null $container
     * @return App
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public static function create(?ContainerInterface $container = null): App
    {
        $container = $container ?: new Container;

        $callableResolver = new InvokerCallableResolver($container);

        $container->set(CallableResolverInterface::class, new \Ody\Core\DI\CallableResolver($callableResolver));
        $app = KernelFactory::createFromContainer($container);

        $container->set(App::class, $app);

        $controllerInvoker = static::createControllerInvoker($container);
        $app->getRouteCollector()->setDefaultInvocationStrategy($controllerInvoker);

        return $app;
    }

    /**
     * Bridge DI
     *
     * @param ContainerInterface $container
     * @return ControllerInvoker
     */
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

    /**
     * @return RouteResolverInterface
     */
    public function getRouteResolver(): RouteResolverInterface
    {
        return $this->routeResolver;
    }

    /**
     * @return MiddlewareDispatcherInterface
     */
    public function getMiddlewareDispatcher(): MiddlewareDispatcherInterface
    {
        return $this->middlewareDispatcher;
    }

    /**
     * @param MiddlewareInterface|string|callable $middleware
     * @return App<TContainerInterface>
     */
    public function add($middleware): self
    {
        $this->middlewareDispatcher->add($middleware);
        return $this;
    }

    /**
     * @param MiddlewareInterface $middleware
     * @return App<TContainerInterface>
     */
    public function addMiddleware(MiddlewareInterface $middleware): self
    {
        $this->middlewareDispatcher->addMiddleware($middleware);
        return $this;
    }

    /**
     * Add the built-in routing middleware to the app middleware stack
     *
     * This method can be used to control middleware order and is not required for default routing operation.
     *
     * @return RoutingMiddleware
     */
    public function addRoutingMiddleware(): RoutingMiddleware
    {
        $routingMiddleware = new RoutingMiddleware(
            $this->getRouteResolver(),
            $this->getRouteCollector()->getRouteParser()
        );
        $this->add($routingMiddleware);
        return $routingMiddleware;
    }

    /**
     * Add the built-in error middleware to the app middleware stack
     *
     * @param bool                 $displayErrorDetails
     * @param bool                 $logErrors
     * @param bool                 $logErrorDetails
     * @param LoggerInterface|null $logger
     *
     * @return ErrorMiddleware
     */
    public function addErrorMiddleware(
        bool $displayErrorDetails,
        bool $logErrors,
        bool $logErrorDetails,
        ?LoggerInterface $logger = null
    ): ErrorMiddleware {
        $errorMiddleware = new ErrorMiddleware(
            $this->getCallableResolver(),
            $this->getResponseFactory(),
            $displayErrorDetails,
            $logErrors,
            $logErrorDetails,
            $logger
        );
        $this->add($errorMiddleware);
        return $errorMiddleware;
    }

    /**
     * Add the body parsing middleware to the app middleware stack
     *
     * @param callable[] $bodyParsers
     *
     * @return BodyParsingMiddleware
     */
    public function addBodyParsingMiddleware(array $bodyParsers = []): BodyParsingMiddleware
    {
        $bodyParsingMiddleware = new BodyParsingMiddleware($bodyParsers);
        $this->add($bodyParsingMiddleware);
        return $bodyParsingMiddleware;
    }

    /**
     * Run application
     *
     * This method traverses the application middleware stack and then sends the
     * resultant Response object to the HTTP client.
     *
     * @param ServerRequestInterface|null $request
     * @return void
     */
    public function run(?ServerRequestInterface $request = null): void
    {
        if (!$request) {
            $serverRequestCreator = ServerRequestCreatorFactory::create();
            $request = $serverRequestCreator->createServerRequestFromGlobals();
        }

        $response = $this->handle($request);
        $responseEmitter = new ResponseEmitter();
        $responseEmitter->emit($response);
    }

    /**
     * Handle a request
     *
     * This method traverses the application middleware stack and then returns the
     * resultant Response object.
     *
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $response = $this->middlewareDispatcher->handle($request);

        /**
         * This is to be in compliance with RFC 2616, Section 9.
         * If the incoming request method is HEAD, we need to ensure that the response body
         * is empty as the request may fall back on a GET route handler due to FastRoute's
         * routing logic which could potentially append content to the response body
         * https://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html#sec9.4
         */
        $method = strtoupper($request->getMethod());
        if ($method === 'HEAD') {
            $emptyBody = $this->responseFactory->createResponse()->getBody();
            return $response->withBody($emptyBody);
        }

        return $response;
    }
}