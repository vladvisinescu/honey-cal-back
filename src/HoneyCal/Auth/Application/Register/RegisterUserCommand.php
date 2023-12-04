<?php

namespace HoneyCal\Auth\Application\Register;

use HoneyCal\Shared\Domain\Bus\Command\Command;

final class RegisterUserCommand implements Command
{
    public function __construct(
        private readonly string $email,
        private readonly string $plainPassword,
    ) {}

    public function email(): string
    {
        return $this->email;
    }

    public function plainPassword(): string
    {
        return $this->plainPassword;
    }
}
