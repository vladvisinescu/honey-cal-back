<?php

namespace HoneyCal\Shared\Infrastructure\Bus\Query;

use HoneyCal\Shared\Domain\Bus\Query\Query;
use HoneyCal\Shared\Domain\Bus\Query\QueryBus;
use HoneyCal\Shared\Domain\Bus\Query\Response;
use HoneyCal\Shared\Infrastructure\Bus\HandlerBuilder;

use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;
use Symfony\Component\Messenger\Exception\NoHandlerForMessageException;
use Symfony\Component\Messenger\Stamp\HandledStamp;

final class InMemorySymfonyQueryBus implements QueryBus
{
    private readonly MessageBus $bus;

    public function __construct(iterable $queryHandlers)
    {
        $this->bus = new MessageBus(
            [
                new HandleMessageMiddleware(
                    new HandlersLocator(HandlerBuilder::forCallables($queryHandlers))
                )
            ]
        );
    }

    public function ask(Query $query): ?Response
    {
        try {
            /** @var HandledStamp $stamp */
            $stamp = $this->bus->dispatch($query)->last(HandledStamp::class);

            return $stamp->getResult();
        } catch (NoHandlerForMessageException) {
            throw new QueryNotRegisteredError($query);
        }
    }
}
