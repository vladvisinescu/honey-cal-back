<?php

namespace HoneyCal\Shared\Infrastructure\Validator;

use Exception;
use Symfony\Component\Validator\ConstraintViolationListInterface;

final class RequestValidationException extends Exception
{
    public function __construct(
        private ConstraintViolationListInterface $errors
    ) {}

    public function errors(): ConstraintViolationListInterface
    {
        return $this->errors;
    }
}
