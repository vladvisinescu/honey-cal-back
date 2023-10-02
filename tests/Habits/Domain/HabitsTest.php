<?php

namespace HoneyCal\Tests\Habits\Domain;

use HoneyCal\Tests\Habits\Domain\ActionGenerator;
use HoneyCal\Habits\Domain\Action;
use HoneyCal\Habits\Domain\Errors\InvalidActionData;
use HoneyCal\Tests\Habits\HabitsModuleUnitTestCase;

class HabitsTest extends HabitsModuleUnitTestCase
{
    /** @test */
    public function can_instantiate_action_test(): void
    {
        $action = ActionGenerator::generate();

        $this->assertInstanceOf(Action::class, $action);
    }

    /** @test */
    public function throws_error_for_long_title(): void
    {
        $this->expectException(InvalidActionData::class);

        $action = ActionGenerator::generate(title: "This is a very long title that should throw an error");

        $this->assertInstanceOf(Action::class, $action);
    }
}
