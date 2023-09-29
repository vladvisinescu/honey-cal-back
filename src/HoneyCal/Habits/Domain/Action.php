<?php

namespace HoneyCal\Habits\Domain;

use DateTime;
use DateTimeImmutable;
use HoneyCal\Habits\Domain\ActionId;
use HoneyCal\Shared\Domain\Aggregate\AggregateRoot;
use HoneyCal\Shared\Domain\DomainError;
use HoneyCal\Shared\Domain\ValueObject\DateTimeValueObject;

final class Action extends AggregateRoot
{
    private function __construct(
        private ActionId $id,
        private ActionTitle $title,
        private Recurrence $recurrence,
        private DateTimeValueObject $createdAt,
        private DateTimeValueObject $nextOccurrence
    ) {}

    public static function fromPrimitives(
        string $title,
        array $recurrence,
        string $createdAt,
        string $nextOccurrence
    ): self {
        return self::create(
            ActionTitle::fromString($title),
            Recurrence::fromPrimitives(
                $recurrence['every'],
                $recurrence['on'],
                $recurrence['at'],
                $recurrence['starting'],
                $recurrence['ending'],
            ),
            DateTimeValueObject::fromString($createdAt),
            DateTimeValueObject::fromString($nextOccurrence),
        );
    }

    public static function create(
        ActionTitle $title,
        Recurrence $recurrence,
        DateTimeValueObject $createdAt,
        DateTimeValueObject $nextOccurrence
    ): self {
        if (!$title) {
            throw new \Exception('Action title cannot be empty.');
        }

        if ($createdAt < new DateTimeImmutable()) {
            throw new DomainError('Action cannot be created in the past.');
        }

        if (!$recurrence) {
            throw new DomainError('Action recurrence cannot be empty.');
        }

        return new self(
            ActionId::random(),
            $title,
            $recurrence,
            $createdAt,
            $nextOccurrence
        );
    }
}
