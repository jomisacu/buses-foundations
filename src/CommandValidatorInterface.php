<?php

declare(strict_types=1);

namespace Jomisacu\BusesFoundations;

interface CommandValidatorInterface
{
    /**
     * @param CommandInterface|QueryInterface $command
     *
     * @throws InvalidcommandException
     */
    public function validate($command): void;
}
