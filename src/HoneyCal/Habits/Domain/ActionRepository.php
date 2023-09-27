<?php

namespace HoneyCal\Habits\Domain;

interface ActionRepository
{
    public function store(Action $action): void;

    public function get(ActionId $id): Action;
}
