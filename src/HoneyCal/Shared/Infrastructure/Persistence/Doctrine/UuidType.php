<?php

namespace HoneyCal\Shared\Infrastructure\Persistence\Doctrine;

use ReflectionClass;
use Doctrine\DBAL\Types\StringType;
use HoneyCal\Shared\Domain\Utils;
use HoneyCal\Shared\Infrastructure\Doctrine\Dbal\DoctrineCustomType;
use function Lambdish\Phunctional\last;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use HoneyCal\Shared\Domain\ValueObject\Uuid;

abstract class UuidType extends StringType implements DoctrineCustomType
{
    abstract protected function typeClassName(): string;

    public static function customTypeName(): string
    {
        return Utils::toSnakeCase(str_replace('Type', '', (string) last(explode('\\', static::class))));
    }

    public function getName(): string
    {
        return self::customTypeName();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        $className = $this->typeClassName();
        /** @psalm-suppress ArgumentTypeCoercion */
        $class = new ReflectionClass("$className::class");
        $instance = $class->newInstanceArgs([$value]);

        return $instance;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        /** @var Uuid $value */
        return $value->value();
    }
}
