<?php

namespace HoneyCal\Auth\Domain\Errors;

use HoneyCal\Shared\Domain\DomainError;

final class InvalidAuthUserData extends DomainError
{
    public function __construct(
        protected string $errorMessage
    ) {}

    public function errorCode(): string
    {
        return 'invalid_authuser_data';
    }

    public function errorMessage(): string
    {
        return $this->errorMessage;
    }
}
