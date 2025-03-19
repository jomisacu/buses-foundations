<?php

declare(strict_types=1);

namespace Jomisacu\BusesFoundations\Middlewares;

use League\Tactician\Middleware;
use Throwable;

final class DatabaseTransactionMiddleware implements Middleware
{
    private readonly \Closure $beginTransactionCallback;
    private readonly \Closure $commitTransactionCallback;
    private readonly \Closure $rollBackTransactionCallback;

    public function __construct(
        callable $beginTransactionCallback,
        callable $commitTransactionCallback,
        callable $rollBackTransactionCallback,
    ) {
        $this->beginTransactionCallback = $beginTransactionCallback(...);
        $this->commitTransactionCallback = $commitTransactionCallback(...);
        $this->rollBackTransactionCallback = $rollBackTransactionCallback(...);
    }

    /**
     * @throws Throwable
     */
    public function execute($command, callable $next)
    {
        $this->beginTransactionCallback->call($this);

        try {
            $returnValue = $next($command);
            $this->commitTransactionCallback->call($this);

            return $returnValue;
        } catch (Throwable $exception) {
            $this->rollBackTransactionCallback->call($this);
            throw $exception;
        }
    }
}
