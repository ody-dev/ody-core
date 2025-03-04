<?php
declare(strict_types=1);

namespace Ody\Core\Foundation\Middleware;

use Ody\Core\Exceptions\HttpException;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Throwable;
use Whoops\Handler\JsonResponseHandler;

class WhoopsMiddleware implements MiddlewareInterface
{
    protected $settings = [];
    protected $handlers = [];

    /**
     * Instance the whoops middleware object
     *
     * @param array $settings
     * @param array $handlers
     */
    public function __construct(array $settings = [], array $handlers = []) {
        $this->settings = $settings;
        $this->handlers = $handlers;
    }

    /**
     * Handle the requests
     *
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {
        $whoopsGuard = new WhoopsGuard($this->settings);
        $whoopsGuard->setRequest($request);
        $whoopsGuard->setHandlers($this->handlers);
        $whoopsGuard->install();

        return $handler->handle($request);

        try {
            return $handler->handle($request);
        } catch (Throwable $e) {
            if (!$e instanceof \Swoole\ExitException) {
//                dd($e->getMessage());
                return $handler->handle($request);
            }
        }
    }

    private function handleException(ServerRequestInterface $request, Throwable $exception): ResponseInterface
    {
        if ($exception instanceof HttpException) {
            $request = $exception->getRequest();
        }

        $exceptionType = get_class($exception);
        $handler = $this->getErrorHandler($exceptionType);

        return $handler($request, $exception, $this->displayErrorDetails, $this->logErrors, $this->logErrorDetails);
    }
}