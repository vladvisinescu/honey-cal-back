<?php

namespace HoneyCal\Habits\Domain\ValueObjects\Action;

use DateTimeImmutable;

final class CreatedAtValueObject extends \HoneyCal\Shared\Domain\ValueObject\DateTimeValueObject
{
    public function isInThePast(): bool
    {
        return $this->value() < new DateTimeImmutable();
    }

    public function isBeforeToday(): bool
    {
        return $this->value() < new DateTimeImmutable('today');
    }
}
