<?php

namespace HoneyCal\Habits\Application\Create;

use HoneyCal\Habits\Domain\Events\ActionCreatedDomainEvent;
use HoneyCal\Shared\Domain\Bus\Event\DomainEventSubscriber;

final class LogActionOnActionCreated implements DomainEventSubscriber
{
    public static function subscribedTo(): array
    {
        return [ActionCreatedDomainEvent::class];
    }

    public function __invoke(ActionCreatedDomainEvent $event): void
    {

    }
}
