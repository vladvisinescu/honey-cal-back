<?php

namespace HoneyCal\Tests\Habits;

use HoneyCal\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use HoneyCal\Tests\Habits\Domain\ActionGenerator;
use HoneyCal\Habits\Domain\Errors\InvalidActionData;
use HoneyCal\Habits\Domain\Errors\InvalidRecurrenceData;

class RecurrenceTest extends UnitTestCase
{
    /** @test */
    public function throws_error_for_invalid_recurrence_every_modifier(): void
    {
        $this->expectException(InvalidRecurrenceData::class);

        $action = ActionGenerator::generate(
            recurrence: [
                'every' => 'month',
                'on' => 'tuesday',
                'at' => '12:00',
                'starting' => '2024-01-01',
                'ending' => '2024-02-01',
            ]
        );
    }

    /** @test */
    public function throws_error_for_invalid_recurrence_starting(): void
    {
        $this->expectException(InvalidRecurrenceData::class);

        $action = ActionGenerator::generate(
            recurrence: [
                'every' => 'day',
                'at' => '11:00',
                'starting' => '2010-01-01',
            ]
        );
    }

    /** @test */
    public function throws_error_for_invalid_recurrence_ending(): void
    {
        $this->expectException(InvalidRecurrenceData::class);

        $action = ActionGenerator::generate(
            recurrence: [
                'every' => 'day',
                'at' => '11:00',
                'starting' => '2024-01-01',
                'ending' => '2023-11-01',
            ]
        );
    }

    /** @test */
    public function throws_error_for_invalid_recurrence_at(): void
    {
        $this->expectException(InvalidRecurrenceData::class);

        $action = ActionGenerator::generate(
            recurrence: [
                'every' => 'day',
                'at' => '11',
            ]
        );
    }
}
