<?php
declare(strict_types=1);

namespace Ody\Core;

use Psr\Log\AbstractLogger;
use Psr\Log\InvalidArgumentException;
use Stringable;

use function error_log;

class Logger extends AbstractLogger
{
    /**
     * @param mixed             $level
     * @param string|Stringable $message
     * @param array<mixed>      $context
     *
     * @throws InvalidArgumentException
     */
    public function log($level, $message, array $context = []): void
    {
        error_log((string) $message);
    }
}
