<?php

namespace HoneyCal\Shared\Infrastructure\Persistence\Doctrine;

use HoneyCal\Shared\Domain\ValueObjects\UpdatedAtValueObject;
use HoneyCal\Shared\Infrastructure\Doctrine\Dbal\DoctrineCustomType;
use HoneyCal\Shared\Infrastructure\Persistence\Doctrine\DateTimeType;

final class UpdatedAtType extends DateTimeType implements DoctrineCustomType
{
    protected function typeClassName(): string
    {
        return UpdatedAtValueObject::class;
    }
}
