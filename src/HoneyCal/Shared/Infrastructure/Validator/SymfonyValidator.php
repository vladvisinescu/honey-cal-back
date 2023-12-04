<?php

namespace HoneyCal\Shared\Infrastructure\Validator;

use HoneyCal\Shared\Domain\Validation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class SymfonyValidator implements Validation
{
    private ?ConstraintViolationListInterface $errors = null;
    private ?Collection $constraints = null;

    public function __construct(
        private readonly ValidatorInterface $validator,
        private readonly ?RequestStack $requestStack,
    ) {}

    public function setConstraints(Collection $constraints): self
    {
        $this->constraints = $constraints;

        return $this;
    }

    public function validate(): void
    {
        $request = $this->requestStack->getMainRequest();

        $this->errors = $this->validator->validate($request->query->all(), $this->constraints);

        if ($this->errors->count() > 0) {
            throw new RequestValidationException($this->errors);
        }
    }

    public function errors(): ConstraintViolationListInterface|null
    {
        return $this->errors;
    }
}
