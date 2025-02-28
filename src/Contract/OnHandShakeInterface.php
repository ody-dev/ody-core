<?php

declare(strict_types=1);
namespace Ody\Core\Contract;

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
