<?php

namespace HoneyCal\Shared\Domain\ValueObjects;

use Stringable;

final class AuthTokenValueObject implements Stringable
{
    public function __construct(
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
