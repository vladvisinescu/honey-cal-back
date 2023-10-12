<?php

namespace HoneyCal\Habits\Domain\Errors;

use HoneyCal\Shared\Domain\DomainError;

final class InvalidActionData extends DomainError
{
    public function __construct(
        protected string $errorMessage
    ) {}

    public function errorCode(): string
    {
        return 'invalid_action_data';
    }

    public function errorMessage(): string
    {
        return $this->errorMessage;
    }
}
