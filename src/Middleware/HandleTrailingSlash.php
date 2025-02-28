<?php

namespace Ody\Core\Middleware;

use Ody\Core\Middleware\Concerns\Redirect;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class HandleTrailingSlash
{
    use Redirect;

    /**
     * @var bool Add or remove the slash
     */
    private $addSlash;

    /**
     * Configure whether add or remove the slash.
     *
     * @param bool $addSlash
     */
    public function __construct($addSlash = false)
    {
        $this->addSlash = (bool) $addSlash;
    }

    /**
     * Execute the middleware.
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param callable               $next
     *
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        $uri = $request->getUri();
        $path = $uri->getPath();

        //Add/remove slash
        if (strlen($path) > 1) {
            if ($this->addSlash) {
                if (substr($path, -1) !== '/' && !pathinfo($path, PATHINFO_EXTENSION)) {
                    $path .= '/';
                }
            } else {
                $path = rtrim($path, '/');
            }
        } elseif ($path === '') {
            $path = '/';
        }

        //redirect
        if ($this->redirectStatus !== false && ($uri->getPath() !== $path)) {
            return $this->getRedirectResponse($request, $uri->withPath($path), $handler);
        }

        return $handler->handle($request->withUri($uri->withPath($path)));
    }
}