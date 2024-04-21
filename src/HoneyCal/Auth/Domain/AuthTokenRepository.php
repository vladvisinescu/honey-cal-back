<?php

namespace HoneyCal\Auth\Domain;

use HoneyCal\Auth\Domain\ValueObjects\AuthToken\AuthTokenId;
use HoneyCal\Shared\Domain\Aggregate\AggregateRoot;

interface AuthTokenRepository
{
    public function store(AggregateRoot $authToken): void;

    public function get(AuthTokenId $authTokenId): ?AuthToken;

    public function searchAll(array $options): array;

    public function findOneByValue(string $accessToken): ?AuthToken;

    public function createForUser(AuthUser $authUser): ?AuthToken;
}
