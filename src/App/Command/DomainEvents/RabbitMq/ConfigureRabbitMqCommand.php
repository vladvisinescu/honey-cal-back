<?php

namespace App\Command\DomainEvents\RabbitMq;

use HoneyCal\Shared\Infrastructure\Bus\Event\RabbitMq\RabbitMqConfigurer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Traversable;

final class ConfigureRabbitMqCommand extends Command
{
    protected static $defaultName = 'honeycal:domain-events:rabbitmq:configure';

    public function __construct(
        private readonly RabbitMqConfigurer $configurer,
        private readonly string $exchangeName,
        private readonly Traversable $subscribers
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('Configure the RabbitMQ to allow publish & consume domain events');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->configurer->configure($this->exchangeName, ...iterator_to_array($this->subscribers));

        return 0;
    }
}
