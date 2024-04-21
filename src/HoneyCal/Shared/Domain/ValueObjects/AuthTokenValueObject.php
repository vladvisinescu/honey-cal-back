<?php

namespace HoneyCal\Shared\Domain\ValueObjects;

use Stringable;

readonly final class AuthTokenValueObject implements Stringable
{
    final public function __construct(
        private string $value,
    ) {}

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value();
    }
}
