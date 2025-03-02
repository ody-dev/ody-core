<?php
declare(strict_types=1);

namespace Ody\Core\Exceptions;

/** @api */
class HttpUnauthorizedException extends HttpSpecializedException
{
    /**
     * @var int
     */
    protected $code = 401;

    /**
     * @var string
     */
    protected $message = 'Unauthorized.';

    protected string $title = '401 Unauthorized';
    protected string $description = 'The request requires valid user authentication.';
}
