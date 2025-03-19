<?php

declare(strict_types=1);

namespace Jomisacu\BusesFoundations;

interface CommandBusInterface
{
    public function dispatch(CommandInterface $command): void;
}
