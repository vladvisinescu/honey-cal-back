<?php

namespace HoneyCal\Habits\Domain\ValueObjects\Action;

use DateTimeImmutable;
use HoneyCal\Shared\Domain\ValueObjects\DateTimeValueObject;

final class CreatedAtValueObject extends DateTimeValueObject
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
