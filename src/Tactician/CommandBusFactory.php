<?php

declare(strict_types=1);

namespace Jomisacu\BusesFoundations\Tactician;

use Jomisacu\BusesFoundations\MiddlewareBag;
use League\Tactician\CommandBus;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor;
use League\Tactician\Handler\Locator\CallableLocator;
use League\Tactician\Handler\Locator\HandlerLocator;
use League\Tactician\Handler\MethodNameInflector\HandleInflector;
use Psr\Container\ContainerInterface;

final class CommandBusFactory
{
    public static function fromContainer(ContainerInterface $container, MiddlewareBag $middlewareBag): CommandBus
    {
        return self::fromHandlersLocatorAndMiddlewares(new HandlersLocatorPsrContainer($container), $middlewareBag);
    }

    public static function fromMiddlewares(MiddlewareBag $middlewareBag): CommandBus
    {
        return self::fromHandlersLocatorAndMiddlewares(self::getDefaultHandlersLocator(), $middlewareBag);
    }

    public static function fromHandlersLocatorAndMiddlewares(
        HandlerLocator $locator,
        MiddlewareBag $middlewareBag
    ): CommandBus {
        $commandNameExtractor = new ClassNameExtractor();
        $commandHandlerMethodNameInflector = new HandleInflector();
        $commandHandlerMiddleware = new CommandHandlerMiddleware($commandNameExtractor, $locator, $commandHandlerMethodNameInflector);

        $middlewareBag->add($commandHandlerMiddleware, 0);

        return new CommandBus($middlewareBag->all());
    }

    public static function quickStart(): CommandBus
    {
        return self::fromHandlersLocatorAndMiddlewares(self::getDefaultHandlersLocator(), new MiddlewareBag());
    }

    private static function getDefaultHandlersLocator(): HandlerLocator
    {
        return new CallableLocator(function ($commandClassName) {
            $commandHandlerClassName = "{$commandClassName}Handler";

            return new $commandHandlerClassName();
        });
    }
}
