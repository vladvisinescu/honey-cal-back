<?php

namespace HoneyCal\Habits\Domain;

use Ramsey\Uuid\Uuid as RamseyUuid;
use HoneyCal\Shared\Domain\ValueObjects\Uuid;

final class ActionId extends Uuid
{
    public static function random(): self
    {
        return new self(RamseyUuid::uuid4()->toString());
    }
}
