<?php

declare(strict_types=1);

namespace Jomisacu\BusesFoundations;

final class CommandErrorsBag
{
    private array $errors = [];

    public function pushError(string $attribute, string $error): void
    {
        $this->errors[$attribute][] = $error;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
