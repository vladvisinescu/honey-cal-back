<?php

namespace HoneyCal\Shared\Domain\ValueObject;

use DateTimeImmutable;

abstract class DateTimeValueObject
{
    public function __construct(
        private \DateTimeImmutable $value,
    ) {}

    public function value(): \DateTimeImmutable
    {
        return $this->value;
    }

    public function equals(DateTimeValueObject $other): bool
    {
        return $this->value() === $other->value();
    }
}
