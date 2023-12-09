<?php

namespace HoneyCal\Shared\Infrastructure\Persistence\Doctrine;

use Doctrine\DBAL\Types\StringType;
use HoneyCal\Shared\Infrastructure\Doctrine\Dbal\DoctrineCustomType;

final class EmailType extends StringType implements DoctrineCustomType
{
    public static function customTypeName(): string
    {
        return EmailValueObject::class;
    }
}
