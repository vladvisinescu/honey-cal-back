<?php

namespace HoneyCal\Tests\Habits\Domain;

use HoneyCal\Habits\Domain\Recurrence;

class RecurrenceGenerator
{
    public static function generate(array $mergeRecurrence = []): Recurrence
    {
        return Recurrence::fromPrimitives(
            ...array_merge(self::generatePrimitives(), $mergeRecurrence)
        );
    }

    public static function generatePrimitives(): array
    {
        return [
            'every' => 'week',
            'on' => 'tuesday',
            'at' => '12:00',
            'starting' => '2024-01-01',
            'ending' => '2024-02-01',
        ];
    }
}
