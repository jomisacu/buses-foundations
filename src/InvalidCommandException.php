<?php

declare(strict_types=1);

namespace Jomisacu\BusesFoundations;

final class InvalidCommandException extends \RuntimeException
{
    private CommandErrorsBag $errorsBag;

    public static function createFromErrorsBag(CommandErrorsBag $errorsBag): self
    {
        $exception = new self();
        $exception->setErrors($errorsBag);

        return $exception;
    }

    public function setErrors(CommandErrorsBag $errorsBag): void
    {
        $this->errorsBag = $errorsBag;
    }

    public function getErrors(): CommandErrorsBag
    {
        return $this->errorsBag;
    }
}
