<?php

declare(strict_types=1);

namespace Jomisacu\BusesFoundations\Tactician;

use Jomisacu\BusesFoundations\CommandBusInterface;
use Jomisacu\BusesFoundations\CommandInterface;
use League\Tactician\CommandBus;

final class CommandBusTactician implements CommandBusInterface
{
    public function __construct(private readonly CommandBus $commandBus)
    {
    }

    public function dispatch(CommandInterface $command): void
    {
        $this->commandBus->handle($command);
    }
}
