<?php

namespace HoneyCal\Tests\Habits\Domain;

use HoneyCal\Habits\Domain\ActionDescription;
use HoneyCal\Habits\Domain\ActionId;
use HoneyCal\Habits\Domain\ActionTitle;
use HoneyCal\Habits\Domain\Events\ActionCreatedDomainEvent;
use HoneyCal\Tests\Shared\Domain\MainGenerator;

final class ActionCreatedDomainEventGenerator
{
    public static function create(
        ?ActionId $id = null,
        ?ActionTitle $title = null,
        ?ActionDescription $description = null
    ): ActionCreatedDomainEvent {
        return new ActionCreatedDomainEvent(
            $id?->value() ?? ActionIdGenerator::create()->value(),
            $title?->value() ?? MainGenerator::random()->word,
            $description?->value() ?? MainGenerator::random()->words(10, true)
        );
    }
}
