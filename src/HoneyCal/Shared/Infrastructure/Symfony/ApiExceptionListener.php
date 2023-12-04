<?php

namespace HoneyCal\Shared\Infrastructure\Symfony;

use HoneyCal\Shared\Infrastructure\Validator\RequestErrorResponse;
use HoneyCal\Shared\Infrastructure\Validator\RequestValidationException;
use HoneyCal\Shared\Infrastructure\Validator\ValidationErrorResponse;
use ReflectionClass;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

use function Lambdish\Phunctional\map;

final readonly class ApiExceptionListener
{
    public function __construct(private ApiExceptionsHttpStatusCodeMapping $exceptionHandler) {}

    public function onException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        match (true) {
            $exception instanceof RequestValidationException => ValidationErrorResponse::from($event, $this->exceptionHandler->statusCodeFor(RequestValidationException::class)),
            default => RequestErrorResponse::from($event, 400),
        };
    }

    private function extractClassName(object $object): string
    {
        $reflect = new ReflectionClass($object);

        return $reflect->getShortName();
    }
}
