<?php

namespace HoneyCal\Shared\Infrastructure\Bus\Event;

use HoneyCal\Shared\Infrastructure\Bus\HandlerBuilder;
use Traversable;

final class DomainEventSubscriberLocator
{
    private readonly array $mapping;

    public function __construct(Traversable $mapping)
    {
        $this->mapping = iterator_to_array($mapping);
    }

    public function allSubscribedTo(string $eventClass)
    {
        // HandlerBuilder::forCallables();

    }
}
