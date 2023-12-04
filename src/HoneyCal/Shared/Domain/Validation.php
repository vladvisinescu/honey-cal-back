<?php

namespace HoneyCal\Shared\Domain;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\ConstraintViolationListInterface;

interface Validation
{
    public function validate(): void;

    public function setConstraints(Collection $constraints): self;

    public function errors(): ConstraintViolationListInterface|null;
}
