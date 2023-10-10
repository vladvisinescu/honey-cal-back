<?php

namespace HoneyCal\Habits\Application\SearchAll;

use HoneyCal\Habits\Application\ActionResponse;
use HoneyCal\Habits\Application\ActionsResponse;
use HoneyCal\Habits\Domain\Action;
use HoneyCal\Habits\Domain\ActionRepository;
use function Lambdish\Phunctional\map;

final class SearchAllActionsRetriever
{
    public function __construct(
        private readonly ActionRepository $repository
    ) {}

    public function searchAll(): ActionsResponse
    {
        return new ActionsResponse(
            ...map(
                $this->toResponse(),
                $this->repository->searchAll()
            )
        );
    }

    private function toResponse(): callable
    {
        return static fn (Action $action) => new ActionResponse(
            $action->id()->value(),
            $action->title()->value(),
            $action->createdAt(),
            $action->nextOccurrence(),
            $action->recurrence()->value(),
        );
    }
}
