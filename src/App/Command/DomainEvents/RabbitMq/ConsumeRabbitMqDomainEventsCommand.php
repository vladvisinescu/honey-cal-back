<?php

namespace App\Command\DomainEvents\RabbitMq;

use HoneyCal\Shared\Infrastructure\Bus\Event\DomainEventSubscriberLocator;
use HoneyCal\Shared\Infrastructure\Bus\Event\RabbitMq\RabbitMqDomainEventsConsumer;
use HoneyCal\Shared\Infrastructure\Doctrine\DatabaseConnections;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use function Lambdish\Phunctional\repeat;

final class ConsumeRabbitMqDomainEventsCommand extends Command
{
    protected static $defaultName = 'honeycal:domain-events:rabbitmq:consume';

    public function __construct(
        private readonly RabbitMqDomainEventsConsumer $consumer,
        private readonly DatabaseConnections          $connections,
        private readonly DomainEventSubscriberLocator $locator
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Consume domain events from the RabbitMQ')
            ->addArgument('queue', InputArgument::REQUIRED, 'Queue name')
            ->addArgument('quantity', InputArgument::REQUIRED, 'Quantity of events to process');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $queueName       = (string) $input->getArgument('queue');
        $eventsToProcess = (int) $input->getArgument('quantity');

        repeat($this->consumer($queueName), $eventsToProcess);

        return 0;
    }

    private function consumer(string $queueName): callable
    {
        return function () use ($queueName): void {
            $subscriber = $this->locator->withRabbitMqQueueNamed($queueName);

            $this->consumer->consume($subscriber, $queueName);

            $this->connections->clear();
        };
    }
}
