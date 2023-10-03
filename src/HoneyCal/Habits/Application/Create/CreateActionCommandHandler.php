<?php

namespace HoneyCal\Habits\Application\Create;

use HoneyCal\Shared\Domain\Bus\Command\CommandHandler;

final class CreateActionCommandHandler implements CommandHandler
{
    public function __construct(
        private readonly ActionCreator $creator
    ) {}

    public function __invoke(CreateActionCommand $command): void
    {
        
    }
}
