<?php

namespace HoneyCal\Habits\Domain;

use HoneyCal\Shared\Domain\ValueObject\StringValueObject;

final class ActionTitle extends StringValueObject
{
    public static function fromString(string $name): self
    {
        if ('' === trim($name)) {
            throw new \Exception('Action title cannot be empty');
        }

        return new self($name);
    }
}
