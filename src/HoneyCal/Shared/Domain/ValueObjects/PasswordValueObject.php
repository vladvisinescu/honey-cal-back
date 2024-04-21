<?php

namespace HoneyCal\Shared\Domain\ValueObjects;

use Stringable;

abstract class PasswordValueObject implements Stringable
{
    public const COST = 12;

    final public function __construct(
        private readonly string $hashedPassword,
    ) {}

    public static function fromPlainString(string $value): static
    {
        return new static(self::hash($value));
    }

    public static function fromHashedString(string $value): self
    {
        return new static($value);
    }

    public function value(): string
    {
        return $this->hashedPassword;
    }

    public function match(string $plainPassword): bool
    {
        return password_verify($plainPassword, $this->hashedPassword);
    }

    public static function hash(string $plainPassword): string
    {
        return password_hash($plainPassword, PASSWORD_BCRYPT, ['cost' => self::COST]);
    }

    public function __toString(): string
    {
        return $this->value();
    }
}
