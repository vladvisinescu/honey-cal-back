<?php

namespace HoneyCal\Habits\Application\Create;

use HoneyCal\Shared\Domain\Bus\Command\Command;

final class CreateActionCommand implements Command
{
    public function __construct(
        private readonly string $title,
        private readonly ?string $description = null,
        private readonly ?array $recurrence = ['every' => 'hour']
    ) {}

    public function title(): string
    {
        return $this->title;
    }

    public function description(): string|null
    {
        return $this->description;
    }

    public function recurrence(): array|null
    {
        return $this->recurrence;
    }
}
