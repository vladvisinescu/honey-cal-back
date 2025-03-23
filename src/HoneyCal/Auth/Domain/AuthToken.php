<?php

namespace HoneyCal\Auth\Domain;

use DateTimeImmutable;
use HoneyCal\Auth\Domain\Errors\InvalidAuthTokenData;
use HoneyCal\Auth\Domain\ValueObjects\AuthToken\AuthTokenCreatedAt;
use HoneyCal\Auth\Domain\ValueObjects\AuthToken\AuthTokenExpiresAt;
use HoneyCal\Auth\Domain\ValueObjects\AuthToken\AuthTokenId;
use HoneyCal\Shared\Domain\Aggregate\AggregateRoot;

final class AuthToken extends AggregateRoot
{
    public function __construct(
        private readonly AuthTokenId        $id,
        private readonly AuthTokenUserId    $userId,
        private readonly AuthTokenToken     $token,
        private readonly AuthTokenCreatedAt $createdAt,
        private readonly AuthTokenExpiresAt $expiresAt
    ) {}

    public static function create(
        AuthTokenId $id,
        AuthTokenUserId $userId,
        AuthTokenToken $token,
        AuthTokenCreatedAt $createdAt,
        AuthTokenExpiresAt $expiresAt
    ): self {

        if (!$id->value()) {
            throw new InvalidAuthTokenData('AuthToken UUID cannot be empty.');
        }

        if (!$userId->value()) {
            throw new InvalidAuthTokenData('AuthToken user ID cannot be empty.');
        }

        if (!$token->value()) {
            throw new InvalidAuthTokenData('AuthToken value cannot be empty.');
        }

        if (!$createdAt->value()) {
            throw new InvalidAuthTokenData('AuthToken created at cannot be empty.');
        }

        if (!$expiresAt->value()) {
            throw new InvalidAuthTokenData('AuthToken expires at cannot be empty.');
        }

        return new self(
            $id,
            $userId,
            $token,
            $createdAt,
            $expiresAt
        );
    }

    public function id(): AuthTokenId
    {
        return $this->id;
    }

    public function token(): AuthTokenToken
    {
        return $this->token;
    }

    public function userId(): AuthTokenUserId
    {
        return $this->userId;
    }

    public function createdAt(): AuthTokenCreatedAt
    {
        return $this->createdAt;
    }

    public function expiresAt(): AuthTokenExpiresAt
    {
        return $this->expiresAt;
    }

    public function isExpired(): bool
    {
        return $this->expiresAt->value() < new DateTimeImmutable();
    }
}
