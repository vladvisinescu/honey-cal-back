<?php

namespace HoneyCal\Shared\Infrastructure\Symfony;

use HoneyCal\Shared\Domain\Bus\Command\Command;
use HoneyCal\Shared\Domain\Bus\Command\CommandBus;
use HoneyCal\Shared\Domain\Bus\Query\Query;
use HoneyCal\Shared\Domain\Bus\Query\QueryBus;
use HoneyCal\Shared\Domain\Bus\Query\Response;
use function Lambdish\Phunctional\each;

abstract class ApiController
{
    public function __construct(
        private readonly QueryBus $queryBus,
        private readonly CommandBus $commandBus,
        ApiExceptionsHttpStatusCodeMapping $exceptionHandler
    ) {
        each(
            fn (int $httpCode, string $exceptionClass) => $exceptionHandler->register($exceptionClass, $httpCode),
            $this->exceptions()
        );
    }

    abstract protected function exceptions(): array;

    protected function ask(Query $query): ?Response
    {
        return $this->queryBus->ask($query);
    }

    protected function dispatch(Command $command): void
    {
        $this->commandBus->dispatch($command);
    }
}
