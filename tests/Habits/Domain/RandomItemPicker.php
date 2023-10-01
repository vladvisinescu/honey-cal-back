<?php

namespace HoneyCal\Tests\Habits\Domain;

use HoneyCal\Tests\Shared\Domain\MainGenerator;

class RandomItemPicker
{
    public static function pickFrom(...$items): mixed
    {
        return MainGenerator::random()->randomElement($items);
    }
}
