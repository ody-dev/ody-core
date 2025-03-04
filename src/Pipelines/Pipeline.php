<?php

namespace Ody\Core\Pipelines;

use Closure;

class Pipeline
{
    protected $passable;
    protected $pipes;
    private array $stages;

    protected string $method = 'handle';

    public static function send($passable): static
    {
        $pipeline = new static;

        $pipeline->passable = $passable;

        return $pipeline;
    }

    public function through(array $pipes): static
    {
        $this->pipes = $pipes;

        return $this;
    }

    public function pipe(callable $callback): static
    {
        $this->stages[] = $callback;

        return $this;
    }

    public function process($payload, callable ...$stages)
    {
        foreach ($stages as $stage) {
            $payload = $stage($payload);
        }

        return $payload;
    }

    public function then(Closure $destination)
    {
        $pipeline = array_reduce(
            array_reverse($this->pipes),
            $this->carry(),
            function ($passable) use ($destination) {
                return $destination($passable);
            }
        );

        return $pipeline($this->passable);
    }

    public function thenReturn()
    {
        return $this->then(function ($passable) {
            return $passable;
        });
    }

    protected function carry(): Closure
    {
        return function ($stack, $pipe) {
            return function ($passable) use ($stack, $pipe) {
                if (is_callable($pipe)) {
                    return $pipe($passable, $stack);
                } elseif (is_object($pipe)) {
                    return $pipe->{$this->method}($passable, $stack);
                } elseif (is_string($pipe) && class_exists($pipe)) {
                    $pipeInstance = new $pipe;
                    return $pipeInstance->{$this->method}($passable, $stack);
                } else {
                    throw new \InvalidArgumentException('Invalid pipe type.');
                }
            };
        };
    }
}