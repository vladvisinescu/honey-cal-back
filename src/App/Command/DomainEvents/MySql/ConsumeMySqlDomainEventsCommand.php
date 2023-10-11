<?php

declare(strict_types=1);

namespace App\Command\DomainEvents\MySql;

use HoneyCal\Shared\Domain\Bus\Event\DomainEvent;
use HoneyCal\Shared\Infrastructure\Bus\Event\DomainEventSubscriberLocator;
use HoneyCal\Shared\Infrastructure\Bus\Event\MySql\MySqlDoctrineDomainEventsConsumer;
use HoneyCal\Shared\Infrastructure\Doctrine\DatabaseConnections;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use function Lambdish\Phunctional\pipe;

final class ConsumeMySqlDomainEventsCommand extends Command
{
    protected static $defaultName = 'honeycal:domain-events:mysql:consume';

    public function __construct(
        private MySqlDoctrineDomainEventsConsumer $consumer,
        private DatabaseConnections $connections,
        private DomainEventSubscriberLocator $subscriberLocator
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Consume domain events from MySql')
            ->addArgument('quantity', InputArgument::REQUIRED, 'Quantity of events to process');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $quantityEventsToProcess = (int) $input->getArgument('quantity');

        $consumer = pipe($this->consumer(), fn () => $this->connections->clear());

        $this->consumer->consume($consumer, $quantityEventsToProcess);

        return 0;
    }

    private function consumer(): callable
    {
        return function (DomainEvent $domainEvent): void {
            $subscribers = $this->subscriberLocator->allSubscribedTo($domainEvent::class);

            foreach ($subscribers as $subscriber) {
                $subscriber($domainEvent);
            }
        };
    }
}
