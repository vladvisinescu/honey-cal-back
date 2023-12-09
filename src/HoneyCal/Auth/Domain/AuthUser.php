<?php

namespace HoneyCal\Auth\Domain;

use HoneyCal\Auth\Domain\Errors\InvalidAuthUserData;
use HoneyCal\Auth\Domain\ValueObjects\AuthUser\AuthUserCreatedAt;
use HoneyCal\Auth\Domain\ValueObjects\AuthUser\AuthUserEmail;
use HoneyCal\Auth\Domain\ValueObjects\AuthUser\AuthUserFirstName;
use HoneyCal\Auth\Domain\ValueObjects\AuthUser\AuthUserId;
use HoneyCal\Auth\Domain\ValueObjects\AuthUser\AuthUserLastName;
use HoneyCal\Auth\Domain\ValueObjects\AuthUser\AuthUserPassword;
use HoneyCal\Auth\Domain\ValueObjects\AuthUser\AuthUserUpdatedAt;
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

    public function id(): AuthUserId
    {
        return $this->id;
    }

    public function email(): AuthUserEmail
    {
        return $this->email;
    }

    public function firstName(): AuthUserFirstName
    {
        return $this->firstName;
    }

    public function lastName(): AuthUserLastName
    {
        return $this->lastName;
    }

    public function password(): AuthUserPassword
    {
        return $this->password;
    }

    public function createdAt(): AuthUserCreatedAt
    {
        return $this->createdAt;
    }

    public function updatedAt(): AuthUserUpdatedAt
    {
        return $this->updatedAt;
    }
}
