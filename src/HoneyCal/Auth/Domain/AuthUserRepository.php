<?php

namespace HoneyCal\Auth\Domain;

use HoneyCal\Auth\Domain\ValueObjects\AuthUser\AuthUserId;
use HoneyCal\Shared\Domain\Aggregate\AggregateRoot;

interface AuthUserRepository
{
    public function store(AggregateRoot $authUser): void;

    public function get(AuthUserId $authUserId): ?AuthUser;

    public function searchAll(): array;
}
