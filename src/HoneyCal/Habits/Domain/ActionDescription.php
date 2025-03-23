<?php

namespace HoneyCal\Habits\Domain;

use HoneyCal\Shared\Domain\ValueObjects\StringValueObject;

final class ActionDescription extends StringValueObject
{
    public static function fromString(string $title = ''): ActionDescription
    {
        return new ActionDescription($title);
    }
}
