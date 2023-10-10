<?php

namespace HoneyCal\Habits\Application;

use HoneyCal\Shared\Domain\Bus\Query\Response;

final class ActionsResponse implements Response
{
    private readonly array $actions;

    public function __construct(
        ActionResponse ...$actions
    ) {
        $this->actions = $actions;
    }

    public function actions(): array
    {
        return $this->actions;
    }

        public function jsonSerialize(): mixed
    {
        return $this->actions();
    }
}
