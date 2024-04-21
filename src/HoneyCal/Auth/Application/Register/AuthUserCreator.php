<?php

namespace HoneyCal\Auth\Application\Register;

use HoneyCal\Auth\Domain\AuthTokenRepository;
use HoneyCal\Auth\Domain\AuthUser;
use HoneyCal\Auth\Domain\AuthUserRepository;
use HoneyCal\Auth\Domain\ValueObjects\AuthUser\AuthUserCreatedAt;
use HoneyCal\Auth\Domain\ValueObjects\AuthUser\AuthUserEmail;
use HoneyCal\Auth\Domain\ValueObjects\AuthUser\AuthUserFirstName;
use HoneyCal\Auth\Domain\ValueObjects\AuthUser\AuthUserId;
use HoneyCal\Auth\Domain\ValueObjects\AuthUser\AuthUserLastName;
use HoneyCal\Auth\Domain\ValueObjects\AuthUser\AuthUserPassword;
use HoneyCal\Auth\Domain\ValueObjects\AuthUser\AuthUserUpdatedAt;
use HoneyCal\Shared\Domain\Bus\Event\EventBus;

final class AuthUserCreator
{
    public function __construct(
        private readonly AuthUserRepository $userRepository,
        private readonly AuthTokenRepository $tokenRepository,
        private readonly EventBus $bus
    ) {}

    public function __invoke(
        AuthUserFirstName $firstName,
        AuthUserLastName $lastName,
        AuthUserEmail $email,
        AuthUserPassword $password
    ): void {
        $uuid = AuthUserId::random();
        $createdAt = AuthUserCreatedAt::now();
        $updatedAt = AuthUserUpdatedAt::now();
        $password = AuthUserPassword::fromPlainString($password->value());

        $authUser = AuthUser::create(
            $uuid,
            $email,
            $firstName,
            $lastName,
            $password,
            $createdAt,
            $updatedAt,
        );

        $this->tokenRepository->createForUser($authUser);
        $this->userRepository->store($authUser);
        $this->bus->publish(...$authUser->pullDomainEvents());
    }
}
