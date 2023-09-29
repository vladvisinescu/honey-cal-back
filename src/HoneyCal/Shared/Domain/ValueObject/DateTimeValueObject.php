<?php

namespace HoneyCal\Shared\Domain\ValueObject;

use Stringable;
use DateTimeImmutable;

abstract class DateTimeValueObject implements Stringable
{
    public function __construct(
        private DateTimeImmutable $value,
    ) {}

    public function value(): DateTimeImmutable
    {
        return $this->value;
}

    public function equals(DateTimeValueObject $other): bool
    {
        return $this->value() === $other->value();
    }

    public static function fromString(string $date): self
    {
        return new static(new DateTimeImmutable($date));
    }

    public function __toString(): string
    {
        return $this->value->format('Y-m-d H:i:s');
    }
}
