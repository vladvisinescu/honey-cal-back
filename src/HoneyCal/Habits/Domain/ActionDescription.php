<?php

namespace HoneyCal\Habits\Domain;

use HoneyCal\Habits\Domain\Errors\InvalidActionData;
use HoneyCal\Shared\Domain\ValueObjects\StringValueObject;

final class ActionDescription extends StringValueObject
{
    public static function fromString(string $title): self
    {
        if ('' === trim($title)) {
            throw new InvalidActionData('Action description cannot be empty');
        }

        return new static($title);
    }
}
