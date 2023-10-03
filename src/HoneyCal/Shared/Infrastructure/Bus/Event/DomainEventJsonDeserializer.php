<?php

namespace HoneyCal\Shared\Infrastructure\Bus\Event;

use HoneyCal\Shared\Domain\Bus\Event\DomainEvent;
use HoneyCal\Shared\Domain\Utils;

final class DomainEventJsonDeserializer
{
    public function __construct(
        private DomainEventMapping $mapping
    ) {}

    public function deserialize(string $domainEventClass): DomainEvent
    {
        $eventData = Utils::jsonDecode($domainEventClass);
        $eventName  = $eventData['data']['type'];
        $eventClass = $this->mapping->for($eventName);

        if (null === $eventClass) {
            throw new RuntimeException("The event <$eventName> doesn't exist or has no subscribers");
        }

        return $eventClass::fromPrimitives(
            $eventData['data']['attributes']['id'],
            $eventData['data']['attributes'],
            $eventData['data']['id'],
            $eventData['data']['occurred_on']
        );
    }
}
