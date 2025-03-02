<?php
declare(strict_types=1);

namespace Ody\Core\Foundation\Interfaces;

/** @api */
interface Psr17FactoryProviderInterface
{
    /**
     * @return string[]
     */
    public static function getFactories(): array;

    /**
     * @param string[] $factories
     */
    public static function setFactories(array $factories): void;

    public static function addFactory(string $factory): void;
}
