<?php

namespace HoneyCal\Shared\Domain\ValueObjects;

use Stringable;
use Ramsey\Uuid\Uuid as RamseyUuid;

abstract class Uuid extends StringValueObject
{
    public static function random(): self
    {
        return new static(RamseyUuid::uuid4()->toString());
    }

    public static function fromString(string $value): self
    {
        return new static($value);
    }

    private function ensureIsValidUuid(): void
    {
        if (!RamseyUuid::isValid($this->value())) {
            throw new \Exception(sprintf('<%s> does not allow the value <%s>.', static::class, $this->value()));
        }
    }
}
