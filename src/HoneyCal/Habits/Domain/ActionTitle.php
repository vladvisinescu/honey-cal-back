<?php

namespace HoneyCal\Habits\Domain;

use HoneyCal\Habits\Domain\Errors\InvalidActionData;
use HoneyCal\Shared\Domain\ValueObject\StringValueObject;

final class ActionTitle extends StringValueObject
{
    public static function fromString(string $title): self
    {
        if ('' === trim($title)) {
            throw new InvalidActionData('Action title cannot be empty');
        }

        if (strlen($title) > 50) {
            throw new InvalidActionData('Action title cannot longer than 50 characters.');
        }

        return new static($title);
    }
}
