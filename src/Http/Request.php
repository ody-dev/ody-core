<?php

namespace Ody\Core\Http;

use Ody\Core\Server\ContextManager;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;
class Request extends SymfonyRequest
{
    public function __construct()
    {
        parent::__construct(
            ContextManager::get('_GET'),
            ContextManager::get('_POST'),
            [],
            [],
            [],
            $_SERVER);
    }

    public static function getInstance(): static
    {
        return new static();
    }

    public function has(string $key): bool
    {
        return $this->query->get($key) !== null;
    }

    public function all(): array
    {
        return $this->query->all();
    }
}