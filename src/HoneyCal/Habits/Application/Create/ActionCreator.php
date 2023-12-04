<?php

namespace HoneyCal\Habits\Application\Create;

use HoneyCal\Habits\Domain\Action;
use HoneyCal\Habits\Domain\ActionDescription;
use HoneyCal\Habits\Domain\ActionId;
use HoneyCal\Habits\Domain\ActionRepository;
use HoneyCal\Habits\Domain\ActionTitle;
use HoneyCal\Habits\Domain\Recurrence;
use HoneyCal\Habits\Domain\ValueObjects\Action\CreatedAtValueObject;
use HoneyCal\Habits\Domain\ValueObjects\Action\NextOccurrenceValueObject;
use HoneyCal\Shared\Domain\Bus\Event\EventBus;

final class ActionCreator
{
    public function __construct(
        private readonly ActionRepository $repository,
        private readonly EventBus $bus
    ) {}

    public function __invoke(
        ActionTitle $title,
        ActionDescription $description,
        Recurrence $recurrence,
        CreatedAtValueObject $createdAt,
        ?NextOccurrenceValueObject $nextOccurrence = null
    ): void {

        $uuid = ActionId::random();

        $action = Action::create(
            $uuid,
            $title,
            $description,
            $recurrence,
            $createdAt,
            $nextOccurrence
        );

        $this->repository->store($action);
        $this->bus->publish(...$action->pullDomainEvents());
    }
}
