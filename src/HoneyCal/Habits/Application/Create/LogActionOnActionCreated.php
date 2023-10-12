<?php

namespace HoneyCal\Habits\Application\Create;

use HoneyCal\Habits\Domain\Events\ActionCreatedDomainEvent;
use HoneyCal\Shared\Domain\Bus\Event\DomainEventSubscriber;
use Psr\Log\LoggerInterface;

final class LogActionOnActionCreated implements DomainEventSubscriber
{

    public function __construct(private LoggerInterface $logger) {}

    public static function subscribedTo(): array
    {
        return [ActionCreatedDomainEvent::class];
    }

    public function __invoke(ActionCreatedDomainEvent $event): void
    {
        $this->logger->info('something to test logging with ' . $event->description());
    }
}
