<?php

namespace HoneyCal\Auth\Infrastructure\Persistence\Doctrine;

use HoneyCal\Auth\Domain\ValueObjects\AuthToken\AuthTokenId;
use HoneyCal\Shared\Infrastructure\Persistence\Doctrine\UuidType;

final class AuthTokenIdType extends UuidType
{
    protected function typeClassName(): string
    {
        return AuthTokenId::class;
    }
}
