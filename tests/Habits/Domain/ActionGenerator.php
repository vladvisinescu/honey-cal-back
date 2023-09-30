<?php

namespace HoneyCal\Tests\Habits\Domain;

use HoneyCal\Habits\Domain\Action;
use HoneyCal\Habits\Domain\ActionTitle;
use HoneyCal\Habits\Domain\Recurrence;
use HoneyCal\Habits\Domain\ValueObjects\Action\CreatedAtValueObject;
use HoneyCal\Habits\Domain\ValueObjects\Action\NextOccurrenceValueObject;

class ActionGenerator
{
    public static function generate(): Action
    {
        $actionTitle = ActionTitle::fromString('Action title');
        $recurrence = Recurrence::fromPrimitives('hour');
        $createdAt = CreatedAtValueObject::fromString('2024-01-01 12:00');
        $nextOccurrence = NextOccurrenceValueObject::fromString('2024-02-01 16:00');

        return Action::create($actionTitle, $recurrence, $createdAt, $nextOccurrence);
    }

    public static function generatePrimitives(): array
    {
        return [
            'title' => 'Action title',
            'recurrence' => [
                'every' => 'day',
                'on' => null,
                'at' => '12:00',
                'starting' => '2021-01-01',
                'ending' => null,
            ],
            'createdAt' => '2021-01-01 12:00',
            'nextOccurrence' => '2021-01-01 12:00',
        ];
    }
}
