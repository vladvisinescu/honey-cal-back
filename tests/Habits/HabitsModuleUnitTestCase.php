<?php

namespace HoneyCal\Tests\Habits;

use HoneyCal\Habits\Domain\ActionRepository;
use HoneyCal\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use Mockery;

abstract class HabitsModuleUnitTestCase extends UnitTestCase
{
    private ActionRepository|Mockery|null $repository;

    protected function reporsitory(): ActionRepository|Mockery
    {
        return $this->repository = $this->repository ?? $this->mock(ActionRepository::class);
    }
}
