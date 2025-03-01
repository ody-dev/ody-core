<?php
declare(strict_types=1);

namespace Ody\Core\Foundation\Routing;

use Ody\Core\Foundation\Interfaces\DispatcherInterface;
use function rawurldecode;

/** @api */
class RoutingResults
{
    public const int NOT_FOUND = 0;
    public const int FOUND = 1;
    public const int METHOD_NOT_ALLOWED = 2;

    protected DispatcherInterface $dispatcher;

    protected string $method;

    protected string $uri;

    /**
     * The status is one of the constants shown above
     * NOT_FOUND = 0
     * FOUND = 1
     * METHOD_NOT_ALLOWED = 2
     */
    protected int $routeStatus;

    protected ?string $routeIdentifier = null;

    /**
     * @var array<string, string>
     */
    protected array $routeArguments;

    /**
     * @param array<string, string> $routeArguments
     */
    public function __construct(
        DispatcherInterface $dispatcher,
        string $method,
        string $uri,
        int $routeStatus,
        ?string $routeIdentifier = null,
        array $routeArguments = []
    ) {
        $this->dispatcher = $dispatcher;
        $this->method = $method;
        $this->uri = $uri;
        $this->routeStatus = $routeStatus;
        $this->routeIdentifier = $routeIdentifier;
        $this->routeArguments = $routeArguments;
    }

    public function getDispatcher(): DispatcherInterface
    {
        return $this->dispatcher;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getRouteStatus(): int
    {
        return $this->routeStatus;
    }

    public function getRouteIdentifier(): ?string
    {
        return $this->routeIdentifier;
    }

    /**
     * @return array<string, string>
     */
    public function getRouteArguments(bool $urlDecode = true): array
    {
        if (!$urlDecode) {
            return $this->routeArguments;
        }

        $routeArguments = [];
        foreach ($this->routeArguments as $key => $value) {
            $routeArguments[$key] = rawurldecode($value);
        }

        return $routeArguments;
    }

    /**
     * @return string[]
     */
    public function getAllowedMethods(): array
    {
        return $this->dispatcher->getAllowedMethods($this->uri);
    }
}
