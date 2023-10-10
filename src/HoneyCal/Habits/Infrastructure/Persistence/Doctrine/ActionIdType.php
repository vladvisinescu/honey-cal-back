<?php

namespace HoneyCal\Habits\Infrastructure\Persistence\Doctrine;

use HoneyCal\Habits\Domain\ActionId;
use HoneyCal\Shared\Infrastructure\Persistence\Doctrine\UuidType;

final class ActionIdType extends UuidType
{
    protected function typeClassName(): string
    {
        return ActionId::class;
    }
}
