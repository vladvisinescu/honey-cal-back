<?php

namespace HoneyCal\Habits\Application\Create;

use DateTimeImmutable;
use Exception;
use HoneyCal\Habits\Domain\ActionDescription;
use HoneyCal\Habits\Domain\ActionTitle;
use HoneyCal\Habits\Domain\Recurrence;
use HoneyCal\Habits\Domain\ValueObjects\Action\CreatedAtValueObject;
use HoneyCal\Shared\Domain\Bus\Command\CommandHandler;

final readonly class CreateActionCommandHandler implements CommandHandler
{
    public function __construct(
        private ActionCreator $creator
    ) {}

    /**
     * @throws Exception
     */
    public function __invoke(CreateActionCommand $command): void
    {
        $title = new ActionTitle($command->title());
        $description = new ActionDescription($command->description() ?? '');
        $recurrence = Recurrence::fromPrimitives(...$command->recurrence());
        $createdAt = new CreatedAtValueObject(new DateTimeImmutable());

        $this->creator->__invoke(
            $title,
            $description,
            $recurrence,
            $createdAt,
        );
    }
}
