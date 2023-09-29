<?php

namespace HoneyCal\Habits\Domain;

use HoneyCal\Shared\Domain\Utils;
use HoneyCal\Shared\Domain\ValueObject\DateTimeValueObject;
use HoneyCal\Shared\Domain\ValueObject\TimeValueObject;

final class Recurrence
{
    private const EVERY = ['hour', 'day', 'week',];
    private const ON = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

    private function __construct(
        private string $every,
        private ?string $on = null,
        private ?TimeValueObject $at = null,
        private ?DateTimeValueObject $starting = null,
        private ?DateTimeValueObject $ending = null,
    ) {}

    public static function fromPrimitives(
        string $every,
        string $on = null,
        string $at = null,
        string $starting = null,
        string $ending = null,
    ): self {
        return self::create([
            'every' => $every,
            'on' => $on,
            'at' => $at,
            'starting' => $starting,
            'ending' => $ending,
        ]);
    }

    public static function create(array $data): self
    {
        // "every" is required and must be one of the following: hour, day, week
        if (!in_array($data['every'], self::EVERY)) {
            throw new \Exception('Invalid recurrence every');
        }

        // "on" is required and must be one of the following: monday, tuesday, wednesday, thursday, friday, saturday, sunday
        if (isset($data['on'])) {
            if (!in_array($data['on'], self::ON)) {
                throw new \Exception('Invalid recurrence on');
            }

            if ($data['every'] !== 'week') {
                throw new \Exception('Invalid recurrence [every, on] combo.');
            }

        }

        if (isset($data['at'])) {
            if (!TimeValueObject::ensureIsValidTime($data['at'])) {
                throw new \Exception('Invalid recurrence at time format.');
            }
        }

        if (isset($data['starting']) && !Utils::checkValidDateString($data['starting'])) {
            throw new \Exception('Invalid recurrence starting date format.');
        }

        if (isset($data['ending']) && !Utils::checkValidDateString($data['ending'])) {
            throw new \Exception('Invalid recurrence ending date format.');
        }

        return new self(
            every: $data['every'],
            on: $data['on'],
            at: new TimeValueObject($data['at']),
            starting: DateTimeValueObject::fromString($data['starting']),
            ending: DateTimeValueObject::fromString($data['ending']),
        );
    }
}
