<?php

namespace HoneyCal\Shared\Domain\ValueObjects;

use Stringable;
use RuntimeException;

abstract class PasswordValueObject implements Stringable
{
    public const COST = 12;

    public function __construct(
        private string $hashedPassword,
    ) {}

    public static function fromPlainString(string $value): self
    {
        return new static(self::hash($value));
    }

    public function fromHashedString(string $value): self
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
        $hashedPassword = password_hash($plainPassword, PASSWORD_BCRYPT, ['cost' => self::COST]);

        if (is_bool($hashedPassword)) {
            throw new RuntimeException('Server error hashing password');
        }

        return (string) $hashedPassword;
    }

    public function __toString(): string
    {
        return $this->value();
    }
}
