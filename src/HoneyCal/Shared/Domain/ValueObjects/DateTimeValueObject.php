<?php

namespace HoneyCal\Shared\Domain\ValueObjects;

use Stringable;
use DateTimeImmutable;

abstract class DateTimeValueObject implements Stringable
{
    public function __construct(
        private DateTimeImmutable $value,
    ) {}

    public function value(): DateTimeImmutable
    {
        return $this->value;
    }

    public static function now(): self
    {
        return new static(new DateTimeImmutable());
    }

    public function equals(DateTimeValueObject $other): bool
    {
        return $this->value() === $other->value();
    }

    public function isInThePast(): bool
    {
        return $this->value() < new DateTimeImmutable();
    }

    public function isBeforeToday(): bool
    {
        return $this->value() < new DateTimeImmutable('today');
    }

    public function __toString(): string
    {
        return $this->value->format('Y-m-d H:i:s');
    }
}
