<?php

namespace HoneyCal\Habits\Domain;

final class Recurrence
{
    private array $rules;

    private function __construct(
        private string $recurrenceString
    ) {
        $this->setRules();
    }

    

    public static function create(
        string $recurrence
        ): self {

        $action = new self($recurrence);

        return $action;
    }

    public function setRules(RecurrenceService $service): void
    {
        $this->rules = RecurrenceParser::fromString($this->recurrenceString);
    }

    public function fromString(string $recurrenceString): self
    {
        return self::create($recurrenceString);
    }
}
