<?php

declare(strict_types=1);
namespace Ody\Core\Contracts;

interface PackerInterface
{
    public function pack($data): string;

    public function unpack(string $data);
}
