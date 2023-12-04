<?php

namespace HoneyCal\Shared\Domain\ValueObjects;

use Stringable;

abstract class EmailValueObject implements Stringable
{
    public function __construct(
        private string $value,
    ) {
        $this->ensureIsValidEmail();
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value();
    }

    private function ensureIsValidEmail(): void
    {
        if (!filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception(sprintf('<%s> does not allow the value <%s>.', static::class, $this->value));
        }
    }
}
