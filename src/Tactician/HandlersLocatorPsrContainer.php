<?php

declare(strict_types=1);

namespace Jomisacu\BusesFoundations\Tactician;

use League\Tactician\Exception\MissingHandlerException;
use League\Tactician\Handler\Locator\HandlerLocator;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

final class HandlersLocatorPsrContainer implements HandlerLocator
{
    public function __construct(private readonly ContainerInterface $container)
    {
    }

    /**
     * @inheritDoc
     */
    public function getHandlerForCommand($commandName)
    {
        if (str_ends_with($commandName, 'Command') || str_ends_with($commandName, 'Query')) {
            $handlerClassName = $commandName . 'Handler';
        } else {
            throw new \InvalidArgumentException('Invalid command name. The command name must end with "Command" or "Query"');
        }

        try {
            $commandHandler = $this->container->get($handlerClassName);
        } catch (NotFoundExceptionInterface) {
            throw MissingHandlerException::forCommand($commandName);
        }

        return $commandHandler;
    }
}
