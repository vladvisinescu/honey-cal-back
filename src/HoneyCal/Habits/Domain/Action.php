<?php

namespace HoneyCal\Habits\Domain;

use DateTimeImmutable;
use HoneyCal\Habits\Domain\ActionId;
use HoneyCal\Habits\Domain\Errors\InvalidActionData;
use HoneyCal\Habits\Domain\Events\ActionCreatedDomainEvent;
use HoneyCal\Habits\Domain\ValueObjects\Action\CreatedAtValueObject;
use HoneyCal\Habits\Domain\ValueObjects\Action\NextOccurrenceValueObject;
use HoneyCal\Shared\Domain\Aggregate\AggregateRoot;

final class Action extends AggregateRoot
{
    private function __construct(
        private ActionId $id,
        private ActionTitle $title,
        private ActionDescription $description,
        private Recurrence $recurrence,
        private CreatedAtValueObject $createdAt,
        private ?NextOccurrenceValueObject $nextOccurrence = null
    ) {}

    public static function fromPrimitives(
        string $title,
        string $description,
        array $recurrence,
        string $createdAt,
        string $nextOccurrence
    ): self {
        return static::create(
            ActionTitle::fromString($title),
            ActionDescription::fromString($description),
            Recurrence::fromPrimitives(...$recurrence),
            new CreatedAtValueObject(new DateTimeImmutable($createdAt)),
            new NextOccurrenceValueObject(new DateTimeImmutable($nextOccurrence)),
        );
    }

    public static function create(
        ActionTitle $title,
        ActionDescription $description,
        Recurrence $recurrence,
        CreatedAtValueObject $createdAt,
        ?NextOccurrenceValueObject $nextOccurrence = null
    ): self {
        $id = ActionId::random();

        if (!$title->value()) {
            throw new InvalidActionData('Invalid action title.');
        }

        // if ($createdAt->isInThePast()) {
        //     throw new InvalidActionData('Invalid action creation date: cannot be in the past.');
        // }

        $action = new self(
            $id,
            $title,
            $description,
            $recurrence,
            $createdAt,
            $nextOccurrence
        );

        $action->record(
            new ActionCreatedDomainEvent(
                $action->id()->value(),
                $action->title()->value(),
                $action->description()->value()
            )
        );

        return $action;
    }

    public function id(): ActionId
    {
        return $this->id;
    }

    public function title(): ActionTitle
    {
        return $this->title;
    }

    public function description(): ActionDescription
    {
        return $this->description;
    }

    public function recurrence(): Recurrence
    {
        return $this->recurrence;
    }

    public function createdAt(): CreatedAtValueObject
    {
        return $this->createdAt;
    }

    public function nextOccurrence(): ?NextOccurrenceValueObject
    {
        return $this->nextOccurrence;
    }

    public function changeTitle(ActionTitle $title): void
    {
        $this->title = $title;
    }

    public function changeRecurrence(Recurrence $recurrence): void
    {
        $this->recurrence = $recurrence;
    }

    public function changeNextOccurrence(NextOccurrenceValueObject $nextOccurrence): void
    {
        $this->nextOccurrence = $nextOccurrence;
    }
}
