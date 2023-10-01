<?php

namespace HoneyCal\Tests\Shared\Domain;

use Faker\Generator;
use Faker\Factory;

final class MainGenerator
{
    private static ?Generator $faker;

    public static function random(): Generator
    {
        return self::$faker = self::$faker ?? Factory::create();
    }
}
