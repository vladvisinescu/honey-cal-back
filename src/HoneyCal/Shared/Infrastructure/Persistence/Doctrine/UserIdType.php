<?php

namespace HoneyCal\Shared\Infrastructure\Persistence\Doctrine;

use HoneyCal\Shared\Domain\ValueObjects\Uuid;
use HoneyCal\Shared\Infrastructure\Doctrine\Dbal\DoctrineCustomType;

class UserIdType extends UuidType implements DoctrineCustomType
{
    public static function customTypeName(): string
    {
        return Uuid::class;
    }
}
