<?php

namespace HoneyCal\Shared\Domain\ValueObject;

abstract class StringValueObject
{
    public function __construct(
        private string $value,
    ) {}

    public function value(): string
    {
        return $this->value;
    }

    public function equals(StringValueObject $other): bool
    {
        return $this->value() === $other->value();
    }
}
