<?php

namespace HoneyCal\Auth\Domain;

use HoneyCal\Auth\Domain\Errors\InvalidAuthUserData;
use HoneyCal\Shared\Domain\Aggregate\AggregateRoot;

final class AuthUser extends AggregateRoot
{
    private function __construct(
        private AuthUserId $id,
        private AuthUserEmail $email,
        private AuthUserFirstName $firstName,
        private AuthUserLastName $lastName,
        private AuthUserPassword $password,
        private AuthUserCreatedAt $createdAt,
        private AuthUserUpdatedAt $updatedAt,
    ) {}

    public static function create(
        AuthUserId $id,
        AuthUserEmail $email,
        AuthUserFirstName $firstName,
        AuthUserLastName $lastName,
        AuthUserPassword $password,
        AuthUserCreatedAt $createdAt,
        AuthUserUpdatedAt $updatedAt,
    ): self {

        if (!$id->value()) {
            throw new InvalidAuthUserData('AuthUser UUID cannot be empty.');
        }

        if (!$email->value()) {
            throw new InvalidAuthUserData('AuthUser email cannot be empty.');
        }

        if (
            !$firstName->value() ||
            (strlen($firstName->value()) < 3) ||
            (strlen($firstName->value()) > 30)
            ) {
            throw new InvalidAuthUserData('AuthUser first name cannot be empty.');
        }

        if (
            !$lastName->value() ||
            (strlen($lastName->value()) < 3) ||
            (strlen($lastName->value()) > 30)
            ) {
            throw new InvalidAuthUserData('AuthUser last name cannot be empty.');
        }

        if (!$password->value()) {
            throw new InvalidAuthUserData('AuthUser password cannot be empty.');
        }

        // @TODO LOGIC HERE

        return new self(
            $id,
            $email,
            $firstName,
            $lastName,
            $password,
            $createdAt,
            $updatedAt,
        );
    }
}
