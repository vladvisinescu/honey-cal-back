<?php

namespace HoneyCal\Shared\Domain\ValueObjects;

use Stringable;

abstract class StringValueObject implements Stringable
{
    final public function __construct(
        private readonly ?string $value = '',
    ) {}

    public static function from(string $value): static
    {
        return new static($value);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(StringValueObject $other): bool
    {
        return $this->value() === $other->value();
    }

    public function isEmpty(): bool
    {
        return $this->value() === '';
    }

    public function __toString(): string
    {
        return $this->value() ?: '';
    }
}
