<?php

namespace HoneyCal\Habits\Domain;

use DateTimeImmutable;
use HoneyCal\Habits\Domain\ActionId;
use HoneyCal\Habits\Domain\Errors\InvalidActionData;
use HoneyCal\Habits\Domain\ValueObjects\Action\CreatedAtValueObject;
use HoneyCal\Habits\Domain\ValueObjects\Action\NextOccurrenceValueObject;
use HoneyCal\Shared\Domain\Aggregate\AggregateRoot;
use HoneyCal\Shared\Domain\ValueObject\DateTimeValueObject;

final class Action extends AggregateRoot
{
    private function __construct(
        private ActionId $id,
        private ActionTitle $title,
        private Recurrence $recurrence,
        private CreatedAtValueObject $createdAt,
        private NextOccurrenceValueObject $nextOccurrence
    ) {}

    public static function fromPrimitives(
        string $title,
        array $recurrence,
        string $createdAt,
        string $nextOccurrence
    ): self {
        return static::create(
            ActionTitle::fromString($title),
            Recurrence::fromPrimitives(
                $recurrence['every'],
                $recurrence['on'],
                $recurrence['at'],
                $recurrence['starting'],
                $recurrence['ending'],
            ),
            CreatedAtValueObject::fromString($createdAt),
            NextOccurrenceValueObject::fromString($nextOccurrence),
        );
    }

    public static function create(
        ActionTitle $title,
        Recurrence $recurrence,
        CreatedAtValueObject $createdAt,
        NextOccurrenceValueObject $nextOccurrence
    ): self {
        $id = ActionId::random();

        if (!$title) {
            throw new InvalidActionData('Invalid action title.');
        }

        if ($createdAt->value() < new DateTimeImmutable()) {
            throw new InvalidActionData('Invalid action creation date: cannot be in the past.');
        }

        if (!$recurrence) {
            throw new InvalidActionData('Invalid action recurrence.');
        }

        return new self(
            $id,
            $title,
            $recurrence,
            $createdAt,
            $nextOccurrence
        );
    }
}
