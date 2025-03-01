<?php

declare(strict_types=1);
namespace Ody\Core\Contracts;

interface OnRequestInterface
{
    /**
     * @param mixed $request swoole request or psr server request
     * @param mixed $response swoole response or swow session
     */
    public function onRequest($request, $response): void;
}
