<?php

namespace HoneyCal\Tests\Habits\Domain;

use HoneyCal\Habits\Domain\Action;
use HoneyCal\Habits\Domain\ActionTitle;
use HoneyCal\Habits\Domain\ValueObjects\Action\CreatedAtValueObject;
use HoneyCal\Habits\Domain\ValueObjects\Action\NextOccurrenceValueObject;
use HoneyCal\Tests\Shared\Domain\MainGenerator;


class ActionGenerator
{
    public static function generate(
        string $title = null,
        array $recurrence = [],
        string $createdAt = null,
        string $nextOccurrence = null
    ): Action {
        $actionTitle = ActionTitle::fromString($title ?? MainGenerator::random()->words(3, true));
        $recurrence = RecurrenceGenerator::generate($recurrence);
        $createdAt = CreatedAtValueObject::fromString($createdAt ?? '2024-01-01 12:00');
        $nextOccurrence = NextOccurrenceValueObject::fromString($nextOccurrence ?? '2024-02-01 16:00');

        return Action::create($actionTitle, $recurrence, $createdAt, $nextOccurrence);
    }

    public static function generatePrimitives(): array
    {
        return [
            'title' => ActionTitle::fromString(MainGenerator::random()->words(3, true))->value(),
            'recurrence' => RecurrenceGenerator::generatePrimitives(),
            'createdAt' => CreatedAtValueObject::fromString('2021-01-01 12:00')->value(),
            'nextOccurrence' => NextOccurrenceValueObject::fromString('2021-01-01 12:00')->value(),
        ];
    }
}
