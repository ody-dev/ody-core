<?php

declare(strict_types=1);
namespace Ody\Core\Contract;

use Countable;

interface TranslatorInterface
{
    /**
     * Get the translation for a given key.
     */
    public function trans(string $key, array $replace = [], ?string $locale = null): array|string;

    /**
     * Get a translation according to an integer value.
     *
     * @param array|Countable|int $number
     */
    public function transChoice(string $key, $number, array $replace = [], ?string $locale = null): string;

    /**
     * Get the default locale being used.
     */
    public function getLocale(): string;

    /**
     * Set the default locale.
     */
    public function setLocale(string $locale);
}
