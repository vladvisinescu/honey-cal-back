<?php

namespace HoneyCal\Habits\Domain;

use DateTime;
use DateTimeImmutable;
use HoneyCal\Habits\Domain\ActionId;
use HoneyCal\Shared\Domain\Aggregate\AggregateRoot;
use HoneyCal\Shared\Domain\DomainError;

final class Action extends AggregateRoot
{
    private function __construct(
        private ActionId $id,
        private ActionTitle $title,
        // private Recurrence $recurrence,
        private DateTimeImmutable $createdAt,
        private DateTimeImmutable $nextOccurrence
    ) {}

    public function create(
        ActionTitle $title,
        // Recurrence $recurrence,
        DateTimeImmutable $createdAt,
        DateTimeImmutable $nextOccurrence
    ): self {
        if (!$title) {
            throw new \Exception('Action title cannot be empty.');
        }

        if ($createdAt < new DateTimeImmutable()) {
            throw new DomainError('Action cannot be created in the past.');
        }

        // if (!$recurrence) {
            // throw new DomainError('Action recurrence cannot be empty.');
        // }

        return new self(
            ActionId::random(),
            $title,
            // $recurrence,
            $createdAt,
            $nextOccurrence
        );
    }
}
