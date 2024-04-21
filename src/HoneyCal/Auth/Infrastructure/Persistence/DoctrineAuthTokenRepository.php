<?php

namespace HoneyCal\Auth\Infrastructure\Persistence;

use HoneyCal\Auth\Domain\AuthToken;
use HoneyCal\Auth\Domain\AuthTokenRepository;
use HoneyCal\Auth\Domain\AuthTokenToken;
use HoneyCal\Auth\Domain\AuthTokenUserId;
use HoneyCal\Auth\Domain\AuthUser;
use HoneyCal\Auth\Domain\ValueObjects\AuthToken\AuthTokenCreatedAt;
use HoneyCal\Auth\Domain\ValueObjects\AuthToken\AuthTokenId;
use HoneyCal\Shared\Domain\Aggregate\AggregateRoot;
use HoneyCal\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

final class DoctrineAuthTokenRepository extends DoctrineRepository implements AuthTokenRepository
{

    public function __construct(
        private readonly JWTTokenManagerInterface $jwtManager
    ) {
    }

    public function store(AggregateRoot $authToken): void
    {
        $this->persist($authToken);
    }

    public function get(AuthTokenId $authTokenId): AuthToken
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

    public function createForUser(AuthUser $authUser): AuthToken
    {
        $token = $this->jwtManager->create($authUser);
        $authToken = AuthToken::create(
            AuthTokenId::random(),
            AuthTokenUserId::fromString($authUser->id()->value()),
            AuthTokenToken::from($token),
            AuthTokenCreatedAt::now(),
            $expiresAt
        );

        $this->store($authToken);

        return $authToken;
    }
}
