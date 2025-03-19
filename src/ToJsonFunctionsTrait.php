<?php

declare(strict_types=1);

namespace Jomisacu\BusesFoundations;

trait ToJsonFunctionsTrait
{
    public function toJson(): string
    {
        return \json_encode($this->toArray()) ?: '{}';
    }

    public function jsonSerialize(): mixed
    {
        return $this->toJson();
    }
}
