<?php

namespace HoneyCal\Shared\Domain\ValueObjects;

use Stringable;
use Ramsey\Uuid\Uuid as RamseyUuid;

class Uuid implements Stringable
{
    public function __construct(
        private string $value,
    ) {
        $this->ensureIsValidUuid();
    }

    public function value(): string
    {
        return $this->value;
    }

    public static function random(): self
    {
        return new self(RamseyUuid::uuid4()->toString());
    }

    public static function fromString(string $value): self
    {
        return new self($value);
    }

    public function __toString(): string
    {
        return $this->value;
    }

    private function ensureIsValidUuid(): void
    {
        if (!RamseyUuid::isValid($this->value)) {
            throw new \Exception(sprintf('<%s> does not allow the value <%s>.', static::class, $this->value));
        }
    }
}
