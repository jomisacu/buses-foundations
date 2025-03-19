<?php

declare(strict_types=1);

namespace Jomisacu\BusesFoundations;

interface QueryBusInterface
{
    public function dispatch(QueryInterface $query): QueryResponseInterface;
}
