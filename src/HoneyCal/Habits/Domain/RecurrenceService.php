<?php

namespace HoneyCal\Habits\Domain;

interface RecurrenceService
{
    public static function fromPrimitives(string $recurrenceString): array;
}
