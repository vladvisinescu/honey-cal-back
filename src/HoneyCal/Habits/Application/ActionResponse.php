<?php

namespace HoneyCal\Habits\Application;

use HoneyCal\Shared\Domain\Bus\Query\Response;

final readonly class ActionResponse implements Response
{
    public function __construct(
        private string $id,
        private string $title,
        private string $description,
        private string $createdAt,
        private string $nextOccurrence,
        private array  $recurrence,
    ) {}

    public function id(): string
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function createdAt(): string
    {
        return $this->createdAt;
    }

    public function nextOccurrence(): string
    {
        return $this->nextOccurrence;
    }

    public function recurrence(): array
    {
        return $this->recurrence;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id(),
            'title' => $this->title(),
            'description' => $this->description(),
            'created_at' => $this->createdAt(),
            'next_occurrence' => $this->nextOccurrence(),
            'recurrence' => $this->recurrence(),
        ];
    }
}
