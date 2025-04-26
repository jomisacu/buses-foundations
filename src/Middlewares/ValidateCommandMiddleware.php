<?php

declare(strict_types=1);

namespace Jomisacu\BusesFoundations\Middlewares;

use InvalidArgumentException;
use Jomisacu\BusesFoundations\CommandInterface;
use Jomisacu\BusesFoundations\QueryInterface;
use League\Tactician\Middleware;
use RuntimeException;

final class ValidateCommandMiddleware implements Middleware
{
    public function execute($command, callable $next)
    {
        $this->ensureCommandIsAnObject($command);

        $this->ensureIsACommandOrAQuery($command);

        $this->ensureHandlerExists($command);

        $this->ensureValidatorClassExists($command);

        return $next($command);
    }

    private function ensureIsACommandOrAQuery(object $command): void
    {
        $isACommand = $command instanceof CommandInterface;
        $isAQuery = $command instanceof QueryInterface;
        if (!$isACommand && !$isAQuery) {
            throw new InvalidArgumentException('Command must implement CommandInterface');
        }
    }

    private function ensureCommandIsAnObject(object $command): void
    {
        if (!is_object($command)) {
            throw new InvalidArgumentException('Command must be an object');
        }
    }

    /**
     * This package is built on top of Tactician that throws an exception if the handler is not found
     * So we don't need to check if the handler exists.
     *
     * This method exists to prevent custom implementations that miss handlers in other forms. i.e. methods.
     * Since Tactician can map commands to methods or classes it's important avoid this kind of mistakes.
     *
     * @param object $command
     *
     * @return void
     * @see \League\Tactician\Exception\MissingHandlerException
     */
    private function ensureHandlerExists(object $command): void
    {
        // nothing to do here
    }

    private function ensureValidatorClassExists(object $command): void
    {
        if (!class_exists($command::class . 'Validator')) {
            $class = $command::class . 'Validator';
            throw new RuntimeException("Validator class $class not found");
        }
    }
}
