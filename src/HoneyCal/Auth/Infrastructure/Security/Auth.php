<?php

namespace HoneyCal\Auth\Infrastructure\Security;

use HoneyCal\Auth\Domain\AuthUser;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class Auth implements UserInterface, PasswordAuthenticatedUserInterface
{
    public function __construct(
        private AuthUser $authUser
    ) {}

    public function getRoles(): array
    {
        return [];
    }

    public function eraseCredentials()
    {
        //
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->authUser->email()->value();
    }

    public function getPassword(): ?string
    {
        return $this->authUser->password()->value();
    }
}
