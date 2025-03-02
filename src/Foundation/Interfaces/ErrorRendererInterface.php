<?php
declare(strict_types=1);

namespace Ody\Core\Foundation\Interfaces;

use Throwable;

interface ErrorRendererInterface
{
    public function __invoke(Throwable $exception, bool $displayErrorDetails): string;
}
