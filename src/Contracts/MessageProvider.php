<?php

declare(strict_types=1);
namespace Ody\Core\Contracts;

interface MessageProvider
{
    /**
     * Get the messages for the instance.
     */
    public function getMessageBag(): MessageBag;
}
