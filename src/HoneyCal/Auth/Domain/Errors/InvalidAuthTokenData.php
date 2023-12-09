<?php

namespace HoneyCal\Auth\Domain\Errors;

use HoneyCal\Shared\Domain\DomainError;

final class InvalidAuthTokenData extends DomainError
{
    public function __construct(
        protected string $errorMessage
    ) {}

    public function errorCode(): string
    {
        return 'invalid_authtoken_data';
    }

    public function errorMessage(): string
    {
        return $this->errorMessage;
    }
}
