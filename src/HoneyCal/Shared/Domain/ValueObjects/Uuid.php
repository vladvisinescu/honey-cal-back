<?php

namespace HoneyCal\Shared\Domain\ValueObjects;

use Exception;
use Ramsey\Uuid\Uuid as RamseyUuid;

abstract class Uuid extends StringValueObject
{
    public static function random(): static
    {
        return new static(RamseyUuid::uuid4()->toString());
    }

    public static function fromString(string $value): static
    {
        return new static($value);
    }

    /**
     * @throws Exception
     */
    private function ensureIsValidUuid(): void
    {
        if (!RamseyUuid::isValid($this->value())) {
            throw new Exception(sprintf('<%s> does not allow the value <%s>.', static::class, $this->value()));
        }
    }
}
