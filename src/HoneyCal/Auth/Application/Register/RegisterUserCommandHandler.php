<?php

namespace HoneyCal\Auth\Application\Register;

use HoneyCal\Auth\Domain\AuthUserEmail;
use HoneyCal\Auth\Domain\AuthUserPassword;
use HoneyCal\Shared\Domain\Bus\Command\CommandHandler;

final class RegisterUserCommandHandler implements CommandHandler
{

    public function __construct(
        private readonly AuthUserCreator $creator
    ) {}

    public function __invoke(RegisterUserCommand $command)
    {
        $email = new AuthUserEmail($command->email());
        $password = new AuthUserPassword($command->plainPassword());
    }
}
