<?php

namespace HoneyCal\Tests\Habits;

use HoneyCal\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use HoneyCal\Tests\Habits\Domain\ActionGenerator;

class HabitsTest extends UnitTestCase
{
    public function testHabits(): void
    {
        $action = ActionGenerator::generate();
    }
}
