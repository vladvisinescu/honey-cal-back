<?php

namespace HoneyCal\Auth\Application\Register;

use HoneyCal\Auth\Domain\ValueObjects\AuthUser\AuthUserEmail;
use HoneyCal\Auth\Domain\ValueObjects\AuthUser\AuthUserFirstName;
use HoneyCal\Auth\Domain\ValueObjects\AuthUser\AuthUserLastName;
use HoneyCal\Auth\Domain\ValueObjects\AuthUser\AuthUserPassword;
use HoneyCal\Shared\Domain\Bus\Command\CommandHandler;

final class RegisterUserCommandHandler implements CommandHandler
{

    public function __construct(
        private readonly AuthUserCreator $creator
    ) {}

    public function __invoke(RegisterUserCommand $command): void
    {
        $firstName = new AuthUserFirstName($command->firstName());
        $lastName = new AuthUserLastName($command->lastName());
        $email = new AuthUserEmail($command->email());
        $password = new AuthUserPassword($command->plainPassword());

        $this->creator->__invoke($firstName, $lastName, $email, $password);
    }
}
