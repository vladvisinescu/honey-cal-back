<?php

namespace HoneyCal\Auth\Application\Register;

use HoneyCal\Shared\Domain\Bus\Command\Command;

final readonly class RegisterUserCommand implements Command
{
    public function __construct(
        private string $firstName,
        private string $lastName,
        private string $email,
        private string $plainPassword,
    ) {}

    public function firstName(): string
    {
        return $this->firstName;
    }

    public function lastName(): string
    {
        return $this->lastName;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function plainPassword(): string
    {
        return $this->plainPassword;
    }
}
