<?php
declare(strict_types=1);

namespace Ody\Core\Exceptions;

/** @api */
class HttpForbiddenException extends HttpSpecializedException
{
    /**
     * @var int
     */
    protected $code = 403;

    /**
     * @var string
     */
    protected $message = 'Forbidden.';

    protected string $title = '403 Forbidden';
    protected string $description = 'You are not permitted to perform the requested operation.';
}
