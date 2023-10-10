<?php

namespace HoneyCal\Habits\Infrastructure\Persistence\Doctrine;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use ReflectionClass;
use Doctrine\DBAL\Types\StringType;
use HoneyCal\Habits\Domain\ActionId;
use HoneyCal\Habits\Domain\Recurrence;
use HoneyCal\Shared\Infrastructure\Doctrine\Dbal\DoctrineCustomType;
use HoneyCal\Shared\Infrastructure\Persistence\Doctrine\UuidType;

final class RecurrenceType extends StringType implements DoctrineCustomType
{
    public static function customTypeName(): string
    {
        return 'recurrence';
    }

    public function getName(): string
    {
        return self::customTypeName();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        $data = json_decode(html_entity_decode($value), true);

        return Recurrence::fromPrimitives(
            every:    $data['every'],
            on:       $data['on'],
            at:       $data['at'],
            starting: $data['starting'],
            ending:   $data['ending'],
        );
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        $data = $value->value();

        return htmlentities(json_encode([
            "every" =>    $data['every'],
            "on" =>       $data['on'],
            "at" =>       $data['at'],
            "starting" => $data['starting']->format('Y-m-d H:i:s'),
            "ending" =>   $data['ending']->format('Y-m-d H:i:s'),
        ]));
    }
}
