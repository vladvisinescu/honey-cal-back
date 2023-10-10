<?php

namespace HoneyCal\Habits\Domain\Events;

use HoneyCal\Shared\Domain\Bus\Event\DomainEvent;

final class ActionCreatedDomainEvent extends DomainEvent
{
    public function __construct (
        string $id,
        private readonly string $title,
        private readonly string $description,
        string $eventId = null,
        string $occurredOn = null
    ) {
        parent::__construct($id, $eventId, $occurredOn);
    }

    public static function eventName(): string
    {
        return 'action.created';
    }

    public static function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        string $occurredOn
    ): DomainEvent {
        return new self(
            $aggregateId,
            $body['title'],
            $body['description'],
            $eventId,
            $occurredOn
        );
    }

    public function toPrimitives(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
        ];
    }

    public function id(): string
    {
        return $this->aggregateId();
    }

    public function title(): string
    {
        return $this->title;
    }

    public function description(): string
    {
        return $this->description;
    }
}
