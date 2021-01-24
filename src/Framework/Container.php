<?php declare(strict_types=1);

namespace App\Framework;

class Container
{
    private array $entries = [];

    public function addSingleton(string $abstraction, $implementation, bool $override = false): static
    {
        if ($this->has($abstraction) && ! $override) {
            throw new \Exception('[' . $abstraction . '] already bound to container.');
        }

        $this->entries[$abstraction] = $implementation;

        return $this;
    }

    public function has(string $abstraction): bool
    {
        return isset($this->entries[$abstraction]);
    }

    public function get(string $abstraction): ?object
    {
        return $this->entries[$abstraction] ?? null;
    }

    public function construct(string $class, array $arguments = []): object
    {
        // TODO
    }

    public function call(callable $callable)
    {
        // TODO
    }
}
