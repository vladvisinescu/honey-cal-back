<?php

namespace HoneyCal\Habits\Domain;

use DateTimeImmutable;
use Exception;
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
    public ?string $value = null;
    private const EVERY = ['hour', 'day', 'week'];
    private const ON = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

    private function __construct(
        private EveryModifierValueObject $every,
        private ?OnModifierValueObject $on = null,
        private ?AtModifierValueObject $at = null,
        private ?StartingModifierValueObject $starting = null,
        private ?EndingModifierValueObject $ending = null,
    ) {}

    /**
     * @throws Exception
     */
    public static function fromPrimitives(
        string $every,
        ?string $on = null,
        ?string $at = null,
        ?string $starting = null,
        ?string $ending = null,
    ): self {
        return self::create(
            every: new EveryModifierValueObject($every),
            on: $on ? new OnModifierValueObject($on) : null,
            at: $at ? new AtModifierValueObject($at) : null,
            starting: $starting ? new StartingModifierValueObject(new DateTimeImmutable($starting)) : null,
            ending: $ending ? new EndingModifierValueObject(new DateTimeImmutable($ending)) : null,
        );
    }

    public static function create(
        EveryModifierValueObject $every,
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

        if ($starting && !Utils::checkValidDateString((string) $starting)) {
            throw new InvalidRecurrenceData('Invalid recurrence starting date format.');
        }

        if ($ending && !Utils::checkValidDateString((string) $ending)) {
            throw new InvalidRecurrenceData('Invalid recurrence ending date format.');
        }

        $recurrence = new self($every, $on, $at, $starting, $ending);
        $recurrence->setStringValue(json_encode($recurrence->toPrimitives()));

        return $recurrence;
    }

    public function setStringValue(string $value): void
    {
        $this->value = $value;
    }

    public static function getConstants(): array
    {
        return [
            'EVERY' => self::EVERY,
            'ON' => self::ON,
        ];
    }

    public function value(): array
    {
        return $this->toPrimitives();
    }

    public function toPrimitives(): array
    {
        return [
            'every' => $this->every->value(),
            'on' => $this->on?->value(),
            'at' => $this->at?->value(),
            'starting' => $this->starting?->value(),
            'ending' => $this->ending?->value()
        ];
    }
}
