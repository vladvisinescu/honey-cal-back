<?php

namespace HoneyCal\Shared\Domain\ValueObjects;

use Stringable;

abstract class StringValueObject implements Stringable
{
    public function __construct(
        public string $value,
    ) {}

    public function value(): string
    {
        return $this->value;
    }

    public function equals(StringValueObject $other): bool
    {
        return $this->value() === $other->value();
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
