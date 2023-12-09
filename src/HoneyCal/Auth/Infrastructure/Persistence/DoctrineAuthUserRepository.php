<?php

namespace HoneyCal\Auth\Infrastructure\Persistence;

use HoneyCal\Auth\Domain\AuthUser;
use HoneyCal\Auth\Domain\AuthUserRepository;
use HoneyCal\Auth\Domain\ValueObjects\AuthUser\AuthUserId;
use HoneyCal\Shared\Domain\Aggregate\AggregateRoot;
use HoneyCal\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class DoctrineAuthUserRepository extends DoctrineRepository implements AuthUserRepository
{
    public function store(AggregateRoot $authUser): void
    {
        $this->persist($authUser);
    }

    public function get(AuthUserId $authUserId): AuthUser
    {
        return $this->repository(AuthUser::class)->find($authUserId);
    }

    public function searchAll(): array
    {
        return $this->repository(AuthUser::class)->findAll();
    }
}
