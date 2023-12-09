<?php

namespace HoneyCal\Auth\Infrastructure\Security;

use HoneyCal\Auth\Domain\AuthUser;
use HoneyCal\Auth\Infrastructure\Persistence\DoctrineAuthUserRepository;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class AuthProvider implements UserProviderInterface, PasswordUpgraderInterface
{
    public function __construct(
        private DoctrineAuthUserRepository $authUserRepository
    ) {}

    public function refreshUser(UserInterface $user): UserInterface
    {
        dd('refreshUser', $user);
    }

    public function supportsClass(string $class): bool
    {
        return Auth::class === $class;
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        dd('loadUserByIdentifier', $identifier);
    }

    /**
     * Upgrades the hashed password of a user, typically for using a better hash algorithm.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        return;
        // TODO: when hashed passwords are in use, this method should:
        // 1. persist the new password in the user storage
        // 2. update the $user object with $user->setPassword($newHashedPassword);
    }
}
