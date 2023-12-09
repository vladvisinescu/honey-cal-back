<?php

namespace HoneyCal\Auth\Infrastructure\Persistence;

use HoneyCal\Auth\Domain\AuthToken;
use HoneyCal\Auth\Domain\AuthTokenRepository;
use HoneyCal\Auth\Domain\AuthTokenUserId;
use HoneyCal\Auth\Domain\ValueObjects\AuthToken\AuthTokenId;
use HoneyCal\Shared\Domain\Aggregate\AggregateRoot;
use HoneyCal\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

final class DoctrineAuthTokenRepository extends DoctrineRepository implements AuthTokenRepository
{
    public function store(AggregateRoot $authToken): void
    {
        $this->persist($authToken);
    }

    public function get(AuthTokenId $authTokenId): ?AuthToken
    {
        return $this->repository(AuthToken::class)->find($authTokenId);
    }

    public function searchAll(array $options): array
    {
        return $this->repository(AuthToken::class)->findAll();
    }

    public function findOneByValue(string $authToken): ?AuthToken
    {
        return $this->repository(AuthToken::class)->findOneBy(['token' => $authToken]);
    }

    public function createForUser(string $userId): AuthToken
    {
        $authToken = AuthToken::create(
            AuthTokenId::random(),
            AuthTokenUserId::fromString($userId),
            $token,
            $createdAt,
            $expiresAt
        );

        $this->store($authToken);

        return $authToken;
    }
}
