<?php

namespace HoneyCal\Tests\Habits\Domain;

use DateTimeImmutable;
use HoneyCal\Habits\Domain\Action;
use HoneyCal\Habits\Domain\ActionDescription;
use HoneyCal\Habits\Domain\ActionId;
use HoneyCal\Habits\Domain\ActionTitle;
use HoneyCal\Habits\Domain\ValueObjects\Action\CreatedAtValueObject;
use HoneyCal\Habits\Domain\ValueObjects\Action\NextOccurrenceValueObject;
use HoneyCal\Tests\Shared\Domain\MainGenerator;


class ActionGenerator
{
    public static function generate(
        string $id = null,
        string $title = null,
        array $recurrence = [],
        string $createdAt = null,
        string $nextOccurrence = null
    ): Action {
        $actionId = ActionId::random();
        $actionTitle = ActionTitle::fromString($title ?? MainGenerator::random()->words(3, true));
        $actionDescription = ActionDescription::fromString(MainGenerator::random()->words(10, true));
        $recurrence = RecurrenceGenerator::generate($recurrence);
        $createdAt = new CreatedAtValueObject(new DateTimeImmutable($createdAt ?? '2024-01-01 12:00'));
        $nextOccurrence = new NextOccurrenceValueObject(new DateTimeImmutable($nextOccurrence ?? '2024-02-01 16:00'));

        return Action::create($actionId, $actionTitle, $actionDescription, $recurrence, $createdAt, $nextOccurrence);
    }

    public static function generatePrimitives(): array
    {
        return [
            'title' => ActionTitle::fromString(MainGenerator::random()->words(3, true))->value(),
            'recurrence' => RecurrenceGenerator::generatePrimitives(),
            'createdAt' => (new CreatedAtValueObject(new DateTimeImmutable('2021-01-01 12:00')))->value(),
            'nextOccurrence' => (new NextOccurrenceValueObject(new DateTimeImmutable('2021-01-01 12:00')))->value(),
        ];
    }
}
