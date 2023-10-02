<?php

namespace HoneyCal\Tests\Shared\Infrastructure\PhpUnit;

use Mockery;
use PHPUnit\Framework\TestCase;

abstract class UnitTestCase extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function mock(string $className): Mockery\MockInterface|Mockery\LegacyMockInterface
    {
        return Mockery::mock($className);
    }
}
