<?php

namespace HoneyCal\Habits\Infrastructure;

use HoneyCal\Habits\Domain\RecurrenceService;

final class RecurrenceParser implements RecurrenceService
{
    public static function fromPrimitives(string $recurrenceString): array
    {
        return [];
    }
}
