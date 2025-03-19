<?php

declare(strict_types=1);

namespace Jomisacu\BusesFoundations\Tactician;

use Jomisacu\BusesFoundations\QueryBusInterface;
use Jomisacu\BusesFoundations\QueryInterface;
use Jomisacu\BusesFoundations\QueryResponseInterface;
use League\Tactician\CommandBus;

final class QueryBusTactician implements QueryBusInterface
{
    public function __construct(private readonly CommandBus $commandBus)
    {
    }

    public function dispatch(QueryInterface $query): QueryResponseInterface
    {
        return $this->commandBus->handle($query);
    }
}
