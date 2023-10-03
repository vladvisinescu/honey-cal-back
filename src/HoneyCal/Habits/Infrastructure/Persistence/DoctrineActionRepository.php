<?php

namespace HoneyCal\Habits\Infrastructure\Persistence;

use HoneyCal\Habits\Domain\ActionRepository;

final class DoctrineActionRepository extends DoctrineRepository implements ActionRepository
{
    public function store(Action $action): void
    {
        $this->persist($action);
    }

    public function get(ActionId $id): Action
    {
        return $this->repository(Action::class)->find($id);
    }
}
