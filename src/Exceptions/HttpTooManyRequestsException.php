<?php
declare(strict_types=1);

namespace Ody\Core\Exceptions;

/** @api */
class HttpTooManyRequestsException extends HttpSpecializedException
{
    /**
     * @var int
     */
    protected $code = 429;

    /**
     * @var string
     */
    protected $message = 'Too many requests.';

    protected string $title = '429 Too Many Requests';
    protected string $description = 'The client application has surpassed its rate limit, ' .
                                    'or number of requests they can send in a given period of time.';
}
