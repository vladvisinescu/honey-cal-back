<?php

namespace HoneyCal\Habits\Infrastructure\Persistence;

use HoneyCal\Habits\Domain\Action;
use HoneyCal\Habits\Domain\ActionId;
use HoneyCal\Habits\Domain\ActionRepository;
use HoneyCal\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

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

    public function searchAll(): array
    {
        return $this->repository(Action::class)->findAll();
    }
}
