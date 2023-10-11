<?php

namespace HoneyCal\Tests\Shared\Infrastructure\Bus\Event\MySql;

use HoneyCal\Apps\Mooc\Backend\MoocBackendKernel;
use HoneyCal\Shared\Domain\Bus\Event\DomainEvent;
use HoneyCal\Shared\Infrastructure\Bus\Event\DomainEventMapping;
use HoneyCal\Shared\Infrastructure\Bus\Event\MySql\MySqlDoctrineDomainEventsConsumer;
use HoneyCal\Shared\Infrastructure\Bus\Event\MySql\MySqlDoctrineEventBus;
use HoneyCal\Tests\Mooc\Courses\Domain\CourseCreatedDomainEventMother;
use HoneyCal\Tests\Mooc\CoursesCounter\Domain\CoursesCounterIncrementedDomainEventMother;
use HoneyCal\Tests\Shared\Infrastructure\PhpUnit\InfrastructureTestCase;
use Doctrine\ORM\EntityManagerInterface as EntityManager;
use HoneyCal\Tests\Habits\Domain\ActionCreatedDomainEventGenerator;

final class MySqlDoctrineEventBusTest extends InfrastructureTestCase
{
    private MySqlDoctrineEventBus|null             $bus;
    private MySqlDoctrineDomainEventsConsumer|null $consumer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->bus      = new MySqlDoctrineEventBus($this->service(EntityManager::class));
        $this->consumer = new MySqlDoctrineDomainEventsConsumer(
            $this->service(EntityManager::class),
            $this->service(DomainEventMapping::class)
        );
    }

    /** @test */
    public function it_should_publish_and_consume_domain_events_from_msql(): void
    {
        $domainEvent        = ActionCreatedDomainEventGenerator::create();

        $this->bus->publish($domainEvent);

        $this->consumer->consume(
            subscribers: fn (DomainEvent ...$expectedEvents) => $this->assertContainsEquals($domainEvent, $expectedEvents),
            eventsToConsume:  1
        );
    }

    protected function kernelClass(): string
    {
        return MoocBackendKernel::class;
    }
}
