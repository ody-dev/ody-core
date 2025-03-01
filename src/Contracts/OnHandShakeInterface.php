<?php

declare(strict_types=1);
namespace Ody\Core\Contracts;

use Swoole\Http\Request;
use Swoole\Http\Response;

interface OnHandShakeInterface
{
    /**
     * @param Request $request
     * @param Response $response
     */
    public function onHandShake($request, $response): void;
}
