<?php

declare(strict_types=1);

namespace Jomisacu\BusesFoundations;

interface CommandValidatorInterface
{
    public function validate($command): void;
}
