<?php

namespace HoneyCal\Tests\Shared\Infrastructure\PhpUnit;

use PHPUnit\Framework\TestCase;

abstract class UnitTestCase extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }
}
