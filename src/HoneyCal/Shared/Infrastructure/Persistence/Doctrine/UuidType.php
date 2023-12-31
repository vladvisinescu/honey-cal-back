<?php

namespace HoneyCal\Shared\Infrastructure\Persistence\Doctrine;

use Doctrine\DBAL\Types\StringType;
use HoneyCal\Shared\Infrastructure\Doctrine\Dbal\DoctrineCustomType;
use HoneyCal\Shared\Domain\ValueObjects\Uuid;

class UuidType extends StringType implements DoctrineCustomType
{
    public static function customTypeName(): string
    {
        return Uuid::class;
    }
}
