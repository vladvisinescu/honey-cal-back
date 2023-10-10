<?php

namespace HoneyCal\Shared\Infrastructure\Persistence\Doctrine;

use DateTimeImmutable;
use ReflectionClass;
use HoneyCal\Shared\Domain\Utils;
use HoneyCal\Shared\Infrastructure\Doctrine\Dbal\DoctrineCustomType;
use function Lambdish\Phunctional\last;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\DateType;

abstract class DateTimeType extends DateType implements DoctrineCustomType
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

    public function convertToPHPValue($value, AbstractPlatform $platform): mixed
    {

        $className = $this->typeClassName();
        /** @psalm-suppress ArgumentTypeCoercion */
        $class = new ReflectionClass($className);
        $instance = $class->newInstanceArgs([new DateTimeImmutable($value)]);

        return $instance;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value;
    }
}
