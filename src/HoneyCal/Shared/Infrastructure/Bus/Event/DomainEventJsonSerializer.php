<?php

namespace HoneyCal\Shared\Infrastructure\Bus\Event;

use HoneyCal\Shared\Domain\Bus\Event\DomainEvent;

final class DomainEventJsonSerializer
{
    public function serialize(DomainEvent $domainEvent): string
    {
        return json_encode(
            [
                'data' => [
                    'id'          => $domainEvent->eventId(),
                    'type'        => $domainEvent::eventName(),
                    'occurred_on' => $domainEvent->occurredOn(),
                    'attributes'  => array_merge($domainEvent->toPrimitives(), ['id' => $domainEvent->aggregateId()]),
                ],
                'meta' => [],
            ]
        );
    }
}
