<?php

namespace HoneyCal\Shared\Infrastructure\Bus\Event\InMemory;

use HoneyCal\Shared\Domain\Bus\Event\DomainEvent;
use HoneyCal\Shared\Domain\Bus\Event\EventBus;
use HoneyCal\Shared\Infrastructure\Bus\HandlerBuilder;
use Symfony\Component\Messenger\Exception\NoHandlerForMessageException;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;

class InMemorySymfonyEventBus implements EventBus
{
    private readonly MessageBus $bus;

    public function __construct(iterable $subscribers)
    {
        $this->bus = new MessageBus([
            new HandleMessageMiddleware(
                new HandlersLocator(
                    HandlerBuilder::forPipedCallables($subscribers)
                )
            )
        ]);
    }

    public function publish(DomainEvent ...$events): void
    {
        foreach($events as $event) {
            try {
                $this->bus->dispatch($event);
            } catch (NoHandlerForMessageException) {}
        }
    }
}
