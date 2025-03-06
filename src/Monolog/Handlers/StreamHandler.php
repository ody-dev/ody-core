<?php

namespace Ody\Core\Monolog\Handlers;

if (!function_exists('Monolog\Handler\set_error_handler')) {
    function set_error_handler($call)
    {
    }
}

if (!function_exists('Monolog\Handler\restore_error_handler')) {
    function restore_error_handler()
    {
    }
}

use Monolog\Formatter\FormatterInterface;
use Monolog\Formatter\LineFormatter;

/**
 * Class StreamHandler
 * @package Mix\Log\Handler
 */
class StreamHandler extends \Monolog\Handler\StreamHandler
{

    /**
     * {@inheritDoc}
     */
    protected function getDefaultFormatter(): FormatterInterface
    {
        return new LineFormatter("[%datetime%] %channel%.%level_name%: [%file_line%] %message%\n", 'Y-m-d H:i:s', true);
    }

}