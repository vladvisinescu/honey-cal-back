<?php

namespace HoneyCal\Shared\Infrastructure\Persistence\Doctrine;

use HoneyCal\Habits\Domain\ValueObjects\Action\CreatedAtValueObject;
use HoneyCal\Shared\Infrastructure\Doctrine\Dbal\DoctrineCustomType;
use HoneyCal\Shared\Infrastructure\Persistence\Doctrine\DateTimeType;

final class CreatedAtType extends DateTimeType implements DoctrineCustomType
{
    protected function typeClassName(): string
    {
        return CreatedAtValueObject::class;
    }
}
