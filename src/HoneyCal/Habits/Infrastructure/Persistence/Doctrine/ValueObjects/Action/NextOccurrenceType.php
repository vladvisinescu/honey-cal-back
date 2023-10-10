<?php

namespace HoneyCal\Habits\Infrastructure\Persistence\Doctrine\ValueObjects\Action;

use HoneyCal\Habits\Domain\ValueObjects\Action\NextOccurrenceValueObject;
use HoneyCal\Shared\Infrastructure\Persistence\Doctrine\DateTimeType;

final class NextOccurrenceType extends DateTimeType
{
    protected function typeClassName(): string
    {
        return NextOccurrenceValueObject::class;
    }
}
