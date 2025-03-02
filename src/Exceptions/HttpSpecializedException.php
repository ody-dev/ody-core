<?php
declare(strict_types=1);

namespace Ody\Core\Exceptions;

use Psr\Http\Message\ServerRequestInterface;
use Throwable;

abstract class HttpSpecializedException extends HttpException
{
    /**
     * @param ServerRequestInterface $request
     * @param string|null            $message
     * @param Throwable|null         $previous
     */
    public function __construct(ServerRequestInterface $request, ?string $message = null, ?Throwable $previous = null)
    {
        if ($message !== null) {
            $this->message = $message;
        }

        parent::__construct($request, $this->message, $this->code, $previous);
    }
}
