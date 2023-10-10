<?php

namespace HoneyCal\Habits\Domain;

use HoneyCal\Shared\Domain\ValueObjects\StringValueObject;

final class ActionDescription extends StringValueObject
{
    public static function fromString(string $title = ''): self
    {
        return new static($title);
    }
}
