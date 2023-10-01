<?php

namespace HoneyCal\Tests\Habits;

use HoneyCal\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use HoneyCal\Tests\Habits\Domain\ActionGenerator;
use HoneyCal\Habits\Domain\Action;
use HoneyCal\Habits\Domain\Errors\InvalidActionData;

class HabitsTest extends UnitTestCase
{
    /** @test */
    public function can_instantiate_action_test(): void
    {
        $action = ActionGenerator::generate();

        $this->assertInstanceOf(Action::class, $action);
    }
}
