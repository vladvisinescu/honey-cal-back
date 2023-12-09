<?php

namespace HoneyCal\Auth\Domain\ValueObjects\AuthToken;

use Ramsey\Uuid\Uuid as RamseyUuid;
use HoneyCal\Shared\Domain\ValueObjects\Uuid;

final class AuthTokenId extends Uuid
{
    public static function random(): self
    {
        return new self(RamseyUuid::uuid4()->toString());
    }
}
