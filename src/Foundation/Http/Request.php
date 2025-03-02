<?php
declare(strict_types=1);
namespace Ody\Core\Foundation\Http;

use Ody\Swoole\Coroutine\ContextManager;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class Request extends SymfonyRequest
{
    public function __construct()
    {
        parent::__construct(
            ContextManager::get('_GET') ?? $_GET,
            ContextManager::get('_POST') ?? $_POST,
            [],
            ContextManager::get('_COOKIE') ?? $_COOKIE,
            ContextManager::get('_FILES') ?? $_FILES,
            ContextManager::get('_SERVER') ?? $_SERVER
        );
    }

    public static function getInstance(): Request
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