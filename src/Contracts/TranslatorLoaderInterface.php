<?php

declare(strict_types=1);
namespace Ody\Core\Contracts;

interface TranslatorLoaderInterface
{
    /**
     * Load the messages for the given locale.
     */
    public function load(string $locale, string $group, ?string $namespace = null): array;

    /**
     * Add a new namespace to the loader.
     */
    public function addNamespace(string $namespace, string $hint);

    /**
     * Add a new JSON path to the loader.
     */
    public function addJsonPath(string $path);

    /**
     * Get an array of all the registered namespaces.
     */
    public function namespaces(): array;
}
