<?php

namespace HoneyCal\Shared\Infrastructure\Bus;

use HoneyCal\Shared\Domain\Bus\Event\DomainEventSubscriber;
use LogicException;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use ReflectionNamedType;
use function Lambdish\Phunctional\map;
use function Lambdish\Phunctional\reduce;
use function Lambdish\Phunctional\reindex;

final class HandlerBuilder
{
    public static function forCallables(iterable $callables): array
    {
        return map(self::unflatten(), reindex(self::classExtractor(new self()), $callables));
    }

    public static function forPipedCallables(iterable $callables): array
    {
        return reduce(self::pipedCallablesReducer(), $callables, []);
    }

    private static function classExtractor(HandlerBuilder $parameterExtractor): callable
    {
        return static fn (callable $handler): ?string => $parameterExtractor->extract($handler);
    }

    private static function pipedCallablesReducer(): callable
    {
        return static function (mixed $subscribers, DomainEventSubscriber $subscriber): array {
            $subscribedEvents = $subscriber::subscribedTo();

            foreach ($subscribedEvents as $subscribedEvent) {
                $subscribers[$subscribedEvent][] = $subscriber;
            }

            return $subscribers;
        };
    }

    private static function unflatten(): callable
    {
        return static fn ( mixed $value) => [$value];
    }

    /**
     * @throws ReflectionException
     */
    public function extract(mixed $class): ?string
    {
        $reflector = new ReflectionClass($class);
        $method    = $reflector->getMethod('__invoke');

        if ($this->hasOnlyOneParameter($method)) {
            return $this->firstParameterClassFrom($method);
        }

        return null;
    }

    private function firstParameterClassFrom(ReflectionMethod $method): string
    {
        /** @var ReflectionNamedType $fistParameterType */
        $firstParameterType = $method->getParameters()[0]->getType();

        if (null === $firstParameterType) {
            throw new LogicException('Missing type hint for the first parameter of __invoke');
        }

        return $firstParameterType->getName();
    }

    private function hasOnlyOneParameter(ReflectionMethod $method): bool
    {
        return $method->getNumberOfParameters() === 1;
    }
}
