<?php

declare(strict_types=1);
namespace Ody\Core\Contracts;

interface CompressInterface
{
    public function compress(): UnCompressInterface;
}
