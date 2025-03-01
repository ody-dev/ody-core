<?php
declare(strict_types=1);

namespace Ody\Core\Foundation\Factory\Psr17;

use Ody\Core\Foundation\Interfaces\Psr17FactoryProviderInterface;
use function array_unshift;

class Psr17FactoryProvider implements Psr17FactoryProviderInterface
{
    /**
     * @var string[]
     */
    protected static array $factories = [
        SlimPsr17Factory::class,
        HttpSoftPsr17Factory::class,
        NyholmPsr17Factory::class,
        LaminasDiactorosPsr17Factory::class,
        GuzzlePsr17Factory::class,
    ];

    /**
     * {@inheritdoc}
     */
    public static function getFactories(): array
    {
        return static::$factories;
    }

    /**
     * {@inheritdoc}
     */
    public static function setFactories(array $factories): void
    {
        static::$factories = $factories;
    }

    /**
     * {@inheritdoc}
     */
    public static function addFactory(string $factory): void
    {
        array_unshift(static::$factories, $factory);
    }
}
