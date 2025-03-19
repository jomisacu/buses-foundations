<?php

declare(strict_types=1);

namespace Jomisacu\BusesFoundations;

interface QueryResponseInterface extends \JsonSerializable
{
    public function toJson(): string;

    public function toArray(): array;
}
