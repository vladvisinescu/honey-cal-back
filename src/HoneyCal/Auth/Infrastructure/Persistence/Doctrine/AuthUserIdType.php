<?php

namespace HoneyCal\Auth\Infrastructure\Persistence\Doctrine;

use HoneyCal\Auth\Domain\AuthUserId;
use HoneyCal\Shared\Infrastructure\Persistence\Doctrine\UuidType;

final class AuthUserIdType extends UuidType
{
    protected function typeClassName(): string
    {
        return AuthUserId::class;
    }
}
