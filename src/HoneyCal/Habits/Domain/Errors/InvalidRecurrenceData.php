<?php

namespace HoneyCal\Habits\Domain\Errors;

use HoneyCal\Shared\Domain\DomainError;

final class InvalidRecurrenceData extends DomainError
{
    public function __construct(
        protected string $errorMessage
    ) {
        parent::__construct($this->errorMessage);
    }

    public function errorCode(): string
    {
        return 'invalid_recurrence_data';
    }

    public function errorMessage(): string
    {
        return $this->errorMessage;
    }
}
