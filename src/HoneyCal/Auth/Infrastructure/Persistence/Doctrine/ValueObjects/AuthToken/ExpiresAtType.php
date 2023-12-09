<?php

namespace HoneyCal\Auth\Infrastructure\Persistence\Doctrine\ValueObjects\AuthToken;

use HoneyCal\Auth\Domain\ValueObjects\AuthToken\AuthTokenExpiresAt;
use HoneyCal\Shared\Infrastructure\Persistence\Doctrine\DateTimeType;

final class ExpiresAtType extends DateTimeType
{
    protected function typeClassName(): string
    {
        return AuthTokenExpiresAt::class;
    }
}
