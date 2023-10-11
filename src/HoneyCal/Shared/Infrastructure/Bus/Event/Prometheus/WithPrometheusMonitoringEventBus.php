<?php

declare(strict_types=1);

namespace HoneyCal\Shared\Infrastructure\Bus\Event\Prometheus;

use HoneyCal\Shared\Domain\Bus\Event\DomainEvent;
use HoneyCal\Shared\Domain\Bus\Event\EventBus;
use HoneyCal\Shared\Infrastructure\Monitoring\PrometheusMonitor;
use function Lambdish\Phunctional\each;

final class WithPrometheusMonitoringEventBus implements EventBus
{
    public function __construct(
        private readonly PrometheusMonitor $monitor,
        private readonly string $appName,
        private readonly EventBus $bus
    ) {
    }

    public function publish(DomainEvent ...$events): void
    {
        $counter = $this->monitor->registry()->getOrRegisterCounter(
            $this->appName,
            'domain_event',
            'Domain Events',
            ['name']
        );

        each(fn (DomainEvent $event) => $counter->inc(['name' => $event::eventName()]), $events);

        $this->bus->publish(...$events);
    }
}
