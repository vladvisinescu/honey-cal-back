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
    ) {}

    public static function eventName(): string
    {
        return 'action.created';
    }

    public static function fromPrimitives(
        string $id,
        array $body,
        string $eventId = null,
        string $occurredOn = null
    ): DomainEvent {
        return new self(
            $id,
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

    public function title(): string
    {
        return $this->title;
    }

    public function description(): string
    {
        return $this->description;
    }
}
