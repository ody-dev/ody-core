<?php

declare(strict_types=1);
namespace Ody\Core\Contract;

interface IPReaderInterface
{
    public function read(): string;
}
