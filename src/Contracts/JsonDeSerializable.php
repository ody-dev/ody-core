<?php

declare(strict_types=1);
namespace Ody\Core\Contracts;

interface JsonDeSerializable
{
    public static function jsonDeSerialize(mixed $data): static;
}
