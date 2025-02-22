<?php
declare(strict_types=1);

namespace Ody\Core\Interfaces;

use Psr\Http\Message\ServerRequestInterface;

interface ServerRequestCreatorInterface
{
    public function createServerRequestFromGlobals(): ServerRequestInterface;
}
