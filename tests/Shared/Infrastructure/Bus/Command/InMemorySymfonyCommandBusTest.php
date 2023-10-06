<?php

namespace HoneyCal\Tests\Shared\Infrastructure\Bus\Command;

use HoneyCal\Shared\Domain\Bus\Command\Command;
use HoneyCal\Shared\Infrastructure\Bus\Command\CommandNotRegisteredError;
use HoneyCal\Shared\Infrastructure\Bus\Command\InMemorySymfonyCommandBus;
use HoneyCal\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use Mockery\MockInterface;
use RuntimeException;

final class InMemorySymfonyCommandBusTest extends UnitTestCase
{
    private InMemorySymfonyCommandBus|null $bus;

    public function setUp(): void
    {
        $this->bus = new InMemorySymfonyCommandBus([$this->commandHandler()]);

        parent::setUp();
    }

    /** @test */
    public function it_should_handle_a_command(): void
    {
        $this->expectException(RuntimeException::class);

        $this->bus->dispatch(new FakeCommand());
    }

    /** @test */
    public function it_should_throw_an_exception_for_a_non_registered_command(): void
    {
        $this->expectException(CommandNotRegisteredError::class);

        $this->bus->dispatch($this->command());
    }

    private function commandHandler(): object
    {
        return new class {
            public function __invoke(FakeCommand $command): void
            {
                throw new RuntimeException('This works fine!');
            }
        };
    }

    private function command(): Command|MockInterface
    {
        return $this->mock(Command::class);
    }
}
