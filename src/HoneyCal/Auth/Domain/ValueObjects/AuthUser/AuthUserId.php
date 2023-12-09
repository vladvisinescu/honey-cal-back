<?php

namespace HoneyCal\Auth\Domain\ValueObjects\AuthUser;

use Ramsey\Uuid\Uuid as RamseyUuid;
use HoneyCal\Shared\Domain\ValueObjects\Uuid;

final class AuthUserId extends Uuid
{
    public static function random(): self
    {
        return new self(RamseyUuid::uuid4()->toString());
    }
}
