<?php

namespace HoneyCal\Tests\Habits\Domain;

use HoneyCal\Habits\Domain\ActionId;
use HoneyCal\Tests\Shared\Domain\MainGenerator;

final class ActionIdGenerator
{
    public static function create(?string $value = null): ActionId
    {
        return new ActionId($value ?? MainGenerator::random()->unique()->uuid);
    }
}
