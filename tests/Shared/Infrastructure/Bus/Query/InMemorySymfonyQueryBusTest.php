<?php

namespace HoneyCal\Tests\Shared\Infrastructure\Bus\Query;

use HoneyCal\Shared\Domain\Bus\Query\Query;
use HoneyCal\Shared\Infrastructure\Bus\Query\InMemorySymfonyQueryBus;
use HoneyCal\Shared\Infrastructure\Bus\Query\QueryNotRegisteredError;
use HoneyCal\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use Mockery\MockInterface;
use RuntimeException;

final class InMemorySymfonyQueryBusTest extends UnitTestCase
{
    private InMemorySymfonyQueryBus|null $bus;

    public function setUp(): void
    {
        $this->bus = new InMemorySymfonyQueryBus([$this->queryHandler()]);

        parent::setUp();
    }

    /** @test */
    public function it_should_handle_a_query(): void
    {
        $this->expectException(RuntimeException::class);
        $this->bus->ask(new FakeQuery());
    }

    /** @test */
    public function it_should_throw_an_exception_for_a_non_registered_query(): void
    {
        $this->expectException(QueryNotRegisteredError::class);
        $this->bus->ask($this->query());
    }

    private function query(): Query|MockInterface
    {
        return $this->mock(Query::class);
    }

    private function queryHandler(): object
    {
        return new class {
            public function __invoke(FakeQuery $query): void
            {
                throw new RuntimeException('This works fine!');
            }
        };
    }
}
