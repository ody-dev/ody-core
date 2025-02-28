<?php

declare(strict_types=1);
namespace Ody\Core\Contract;

interface CastsInboundAttributes
{
    /**
     * Transform the attribute to its underlying model values.
     *
     * @param object $model
     * @param mixed $value
     * @return array
     */
    public function set($model, string $key, $value, array $attributes);
}
