<?php

namespace Ody\Core\Foundation\Concerns;

trait ContainerMethods
{
    public function runningInConsole(): bool
    {
        if ($this->getContainer()->has('runningInConsole')) {
            return $this->getContainer()->get('runningInConsole');
        }

        return false;
    }

    public function call(...$parameters)
    {
        return $this->getContainer()->call(...$parameters);
    }

    public function has(...$parameters)
    {
        return $this->getContainer()->has(...$parameters);
    }

    public function bind(...$parameters): void
    {
        $this->getContainer()->set(...$parameters);
    }

    public function make(...$parameters)
    {
        return $this->getContainer()->make(...$parameters);
    }

    public function resolve(...$parameters)
    {
        return $this->getContainer()->get(...$parameters);
    }
}