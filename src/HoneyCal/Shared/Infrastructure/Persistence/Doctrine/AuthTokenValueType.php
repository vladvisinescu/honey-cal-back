<?php

namespace HoneyCal\Shared\Infrastructure\Persistence\Doctrine;

use Doctrine\DBAL\Types\StringType;
use HoneyCal\Shared\Domain\ValueObjects\AuthTokenValueObject;
use HoneyCal\Shared\Infrastructure\Doctrine\Dbal\DoctrineCustomType;

class AuthTokenValueType extends StringType implements DoctrineCustomType
{
    public static function customTypeName(): string
    {
        return AuthTokenValueObject::class;
    }
}
