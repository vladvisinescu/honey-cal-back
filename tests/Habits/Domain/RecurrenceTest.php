<?php

namespace HoneyCal\Tests\Habits\Domain;

use HoneyCal\Tests\Habits\Domain\ActionGenerator;
use HoneyCal\Habits\Domain\Errors\InvalidRecurrenceData;
use HoneyCal\Tests\Habits\HabitsModuleUnitTestCase;

class RecurrenceTest extends HabitsModuleUnitTestCase
{
    /** @test */
    public function throws_error_for_invalid_recurrence_every_modifier(): void
    {
        $this->expectException(InvalidRecurrenceData::class);

        ActionGenerator::generate(
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

        ActionGenerator::generate(
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

        ActionGenerator::generate(
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

        ActionGenerator::generate(
            recurrence: [
                'every' => 'day',
                'at' => '11',
            ]
        );
    }
}
