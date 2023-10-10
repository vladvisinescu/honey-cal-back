<?php

namespace HoneyCal\Habits\Infrastructure\Persistence\Doctrine\ValueObjects\Action;

use HoneyCal\Habits\Domain\ValueObjects\Action\CreatedAtValueObject;
use HoneyCal\Shared\Infrastructure\Persistence\Doctrine\DateTimeType;

final class CreatedAtType extends DateTimeType
{
    protected function typeClassName(): string
    {
        return CreatedAtValueObject::class;
    }
}
