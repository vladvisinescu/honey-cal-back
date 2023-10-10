<?php

namespace HoneyCal\Shared\Domain\ValueObjects;

use Stringable;

abstract class TimeValueObject implements Stringable
{
    private const TIME_REGEX = '\([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?\i';

    public function __construct(
        private string $value,
    ) {
        $this->ensureIsValidTime($value);
    }

    public function value(): string
    {
        return $this->value;
    }

    public static function fromString(string $value): self
    {
        return new static($value);
    }

    public function equals(DateTimeValueObject $other): bool
    {
        return $this->value() == $other->value();
    }

    public static function ensureIsValidTime(string $date): bool
    {
        return true;
        // return preg_match(self::TIME_REGEX, $date) !== false;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
