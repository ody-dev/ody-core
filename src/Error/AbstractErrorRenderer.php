<?php
declare(strict_types=1);

namespace Ody\Core\Error;

use Ody\Core\Exception\HttpException;
use Ody\Core\Interfaces\ErrorRendererInterface;
use Throwable;

/**
 * Abstract Slim application error renderer
 *
 * It outputs the error message and diagnostic information in one of the following formats:
 * JSON, XML, Plain Text or HTML
 */
abstract class AbstractErrorRenderer implements ErrorRendererInterface
{
    protected string $defaultErrorTitle = 'Slim Application Error';

    protected string $defaultErrorDescription = 'A website error has occurred. Sorry for the temporary inconvenience.';

    protected function getErrorTitle(Throwable $exception): string
    {
        if ($exception instanceof HttpException) {
            return $exception->getTitle();
        }

        return $this->defaultErrorTitle;
    }

    protected function getErrorDescription(Throwable $exception): string
    {
        if ($exception instanceof HttpException) {
            return $exception->getDescription();
        }

        return $this->defaultErrorDescription;
    }
}
