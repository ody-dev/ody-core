<?php

namespace Ody\Core\Exceptions;

class DdSwooleException extends \Exception
{
    public $code = 500;

    public function __construct($message = "", $code = 0)
    {
        $this->message = json_encode($message, JSON_UNESCAPED_UNICODE);
        parent::__construct($message, $code);
    }
}