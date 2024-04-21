<?php

namespace HoneyCal\Shared\Domain\ValueObjects;

abstract class IntValueObject
{
    final public function __construct(
        private readonly int $value,
    ) {}

    public function value(): int
    {
        return $this->value;
    }

    public function equals(IntValueObject $other): bool
    {
        return $this->value() === $other->value();
    }

    public function isBiggerThan(IntValueObject $other): bool
    {
        return $this->value() > $other->value();
    }

    public function isLessThan(IntValueObject $other): bool
    {
        return $this->value() < $other->value();
    }
}
