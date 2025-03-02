<?php
declare(strict_types=1);

namespace Ody\Core\Exceptions;

/** @api */
class HttpBadRequestException extends HttpSpecializedException
{
    /**
     * @var int
     */
    protected $code = 400;

    /**
     * @var string
     */
    protected $message = 'Bad request.';

    protected string $title = '400 Bad Request';
    protected string $description = 'The server cannot or will not process ' .
        'the request due to an apparent client error.';
}
