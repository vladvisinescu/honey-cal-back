<?php

namespace HoneyCal\Auth\Application\Register;

use HoneyCal\Auth\Domain\AuthUser;
use HoneyCal\Auth\Domain\AuthUserEmail;
use HoneyCal\Auth\Domain\AuthUserId;
use HoneyCal\Auth\Domain\AuthUserPassword;
use HoneyCal\Auth\Domain\AuthUserRepository;
use HoneyCal\Shared\Domain\Bus\Event\EventBus;

final class AuthUserCreator
{
    public function __construct(
        private readonly AuthUserRepository $repository,
        private readonly EventBus $bus
    ) {}

    public function __invoke(AuthUserEmail $email, AuthUserPassword $password)
    {
        $uuid = AuthUserId::random();

        $authUser = AuthUser::create(
            $uuid,
            $email,
            $firstName,
            $lastName,
            $password,
            $createdAt,
            $updatedAt,
        );

        $this->repository->store($authUser);
        $this->bus->publish(...$authUser->pullDomainEvents());
    }
}
