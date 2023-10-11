<?php

namespace HoneyCal\Tests\Shared\Infrastructure\Bus\Event\RabbitMq;

use HoneyCal\Habits\Domain\Events\ActionCreatedDomainEvent;
use HoneyCal\Shared\Domain\Bus\Event\DomainEventSubscriber;

final class TestAllWorksOnRabbitMqEventsPublished implements DomainEventSubscriber
{
    public static function subscribedTo(): array
    {
        return [
            ActionCreatedDomainEvent::class,
        ];
    }

    public function __invoke(ActionCreatedDomainEvent $event): void
    {
    }
}
