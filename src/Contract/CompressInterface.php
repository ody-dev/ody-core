<?php

declare(strict_types=1);
namespace Ody\Core\Contract;

interface CompressInterface
{
    public function compress(): UnCompressInterface;
}
