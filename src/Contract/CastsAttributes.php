<?php

declare(strict_types=1);
namespace Ody\Core\Contract;

interface CastsAttributes
{
    /**
     * Transform the attribute from the underlying model values.
     *
     * @param object $model
     * @param mixed $value
     * @return mixed
     */
    public function get($model, string $key, $value, array $attributes);

    /**
     * Transform the attribute to its underlying model values.
     *
     * @param object $model
     * @param mixed $value
     * @return array|string
     */
    public function set($model, string $key, $value, array $attributes);
}
