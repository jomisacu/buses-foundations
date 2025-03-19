<?php

declare(strict_types=1);

namespace Jomisacu\BusesFoundations;

final class MiddlewareBag
{
    private array $middlewares = [];

    public function add(mixed $middleware, int $order): void
    {
        $this->middlewares[] = [
            'order' => $order,
            'middleware' => $middleware,
        ];
    }

    public function all(): array
    {
        usort($this->middlewares, fn ($a, $b) => $a['order'] <=> $b['order']);

        return array_map(fn ($m) => $m['middleware'], $this->middlewares);
    }
}
