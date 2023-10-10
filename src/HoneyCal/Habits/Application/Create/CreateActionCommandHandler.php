<?php

namespace HoneyCal\Habits\Application\Create;

use DateTimeImmutable;
use HoneyCal\Habits\Domain\ActionTitle;
use HoneyCal\Habits\Domain\Recurrence;
use HoneyCal\Habits\Domain\ValueObjects\Action\CreatedAtValueObject;
use HoneyCal\Shared\Domain\Bus\Command\CommandHandler;

final class CreateActionCommandHandler implements CommandHandler
{
    public function __construct(
        private readonly ActionCreator $creator
    ) {}

    public function __invoke(CreateActionCommand $command): void
    {
        $title = new ActionTitle($command->title());
        $recurrence = Recurrence::fromPrimitives(...$command->recurrence());
        $createdAt = new CreatedAtValueObject(new DateTimeImmutable());

        $this->creator->__invoke(
            $title,
            $recurrence,
            $createdAt,
        );
    }
}
