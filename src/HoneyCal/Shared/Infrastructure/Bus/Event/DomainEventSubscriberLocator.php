<?php

namespace HoneyCal\Shared\Infrastructure\Bus\Event;

use HoneyCal\Shared\Domain\Bus\Event\DomainEventSubscriber;
use HoneyCal\Shared\Infrastructure\Bus\Event\RabbitMq\RabbitMqQueueNameFormatter;
use HoneyCal\Shared\Infrastructure\Bus\HandlerBuilder;
use Traversable;
use RuntimeException;
use function Lambdish\Phunctional\search;

final class DomainEventSubscriberLocator
{
    private readonly array $mapping;

    public function __construct(Traversable $mapping)
    {
        $this->mapping = iterator_to_array($mapping);
    }

    public function allSubscribedTo(string $eventClass): array
    {
        $formatted = HandlerBuilder::forPipedCallables($this->mapping);

        return $formatted[$eventClass];
    }

    public function withRabbitMqQueueNamed(string $queueName): DomainEventSubscriber|callable
    {
        $subscriber = search(
            static fn (DomainEventSubscriber $subscriber) => RabbitMqQueueNameFormatter::format($subscriber) === $queueName,
            $this->mapping
        );

        if (null === $subscriber) {
            throw new RuntimeException("There are no subscribers for the <$queueName> queue");
        }

        return $subscriber;
    }
}
