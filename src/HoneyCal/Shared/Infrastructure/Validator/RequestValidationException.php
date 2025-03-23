<?php

namespace HoneyCal\Shared\Infrastructure\Validator;

use Exception;
use Symfony\Component\Validator\ConstraintViolationListInterface;

final class RequestValidationException extends Exception
{
    public function __construct(
        private readonly ConstraintViolationListInterface $errors
    ) {
        parent::__construct();
    }

    public function errors(): ConstraintViolationListInterface
    {
        return $this->errors;
    }
}
