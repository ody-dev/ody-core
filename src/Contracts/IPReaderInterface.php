<?php

declare(strict_types=1);
namespace Ody\Core\Contracts;

interface IPReaderInterface
{
    public function read(): string;
}
