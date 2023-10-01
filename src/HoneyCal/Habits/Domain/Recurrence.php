<?php

namespace HoneyCal\Habits\Domain;

use HoneyCal\Habits\Domain\Errors\InvalidRecurrenceData;
use HoneyCal\Habits\Domain\ValueObjects\Recurrence\AtModifierValueObject;
use HoneyCal\Habits\Domain\ValueObjects\Recurrence\EndingModifierValueObject;
use HoneyCal\Habits\Domain\ValueObjects\Recurrence\EveryModifierValueObject;
use HoneyCal\Habits\Domain\ValueObjects\Recurrence\OnModifierValueObject;
use HoneyCal\Habits\Domain\ValueObjects\Recurrence\StartingModifierValueObject;
use HoneyCal\Shared\Domain\Aggregate\Aggregate;
use HoneyCal\Shared\Domain\Utils;

final class Recurrence extends Aggregate
{
    private const EVERY = ['hour', 'day', 'week'];
    private const ON = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

    private function __construct(
        private EveryModifierValueObject $every,
        private ?OnModifierValueObject $on = null,
        private ?AtModifierValueObject $at = null,
        private ?StartingModifierValueObject $starting = null,
        private ?EndingModifierValueObject $ending = null,
    ) {}

    public static function fromPrimitives(
        string $every,
        ?string $on = null,
        ?string $at = null,
        ?string $starting = null,
        ?string $ending = null,
    ): self {
        return self::create(
            every: EveryModifierValueObject::fromString($every),
            on: $on ? OnModifierValueObject::fromString($on) : null,
            at: $at ? AtModifierValueObject::fromString($at) : null,
            starting: $starting ? StartingModifierValueObject::fromString($starting) : null,
            ending: $ending ? EndingModifierValueObject::fromString($ending) : null,
        );
    }

    public static function create(
        EveryModifierValueObject $every = null,
        OnModifierValueObject $on = null,
        AtModifierValueObject $at = null,
        StartingModifierValueObject $starting = null,
        EndingModifierValueObject $ending = null,
    ): self {
        // "every" is required and must be one of the following: hour, day, week
        if (!in_array($every->value(), self::EVERY)) {
            throw new InvalidRecurrenceData('Invalid recurrence every');
        }

        // "on" is required and must be one of the following:
        // monday, tuesday, wednesday, thursday, friday, saturday, sunday
        if (!is_null($on)) {
            if (!in_array($on->value(), self::ON)) {
                throw new InvalidRecurrenceData('Invalid recurrence on');
            }

            if ($every->value() !== 'week') {
                throw new InvalidRecurrenceData('Invalid recurrence [every, on] combo.');
            }

        }

        if (!is_null($at)) {
            if (!AtModifierValueObject::ensureIsValidTime($at->value())) {
                throw new InvalidRecurrenceData('Invalid recurrence at time format.');
            }
        }

        if ($starting && $starting->value() && !Utils::checkValidDateString($starting)) {
            throw new InvalidRecurrenceData('Invalid recurrence starting date format.');
        }

        if ($ending && $ending->value() && !Utils::checkValidDateString($ending)) {
            throw new InvalidRecurrenceData('Invalid recurrence ending date format.');
        }

        return new self($every, $on, $at, $starting, $ending);
    }
}
