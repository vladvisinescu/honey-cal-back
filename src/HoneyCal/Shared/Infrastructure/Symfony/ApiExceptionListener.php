<?php

declare(strict_types=1);

namespace HoneyCal\Shared\Infrastructure\Symfony;

use HoneyCal\Shared\Domain\DomainError;
use HoneyCal\Shared\Domain\Utils;
use HoneyCal\Shared\Infrastructure\Validator\RequestValidationException;
use ReflectionClass;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Validator\ConstraintViolation;
use Throwable;

use function Lambdish\Phunctional\map;

final readonly class ApiExceptionListener
{
    public function __construct(private ApiExceptionsHttpStatusCodeMapping $exceptionHandler) {}

    public function onException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if($exception instanceof RequestValidationException) {
            $event->setResponse(
                new JsonResponse(
                    [
                        'code' => 'request_validation_error',
                        'message' => 'The input contains input errors.',
                        'errors' => map(
                            fn (ConstraintViolation $error) => [
                                'field' => $error->getPropertyPath(),
                                'message' => $error->getMessage(),
                            ],
                            $exception->errors()
                        )
                    ],
                    $this->exceptionHandler->statusCodeFor(RequestValidationException::class)
                )
            );
        } else {
            $event->setResponse(
                new JsonResponse(
                    [
                        'code' => $this->exceptionCodeFor($exception),
                        'message' => $exception->getMessage(),
                    ],
                    $this->exceptionHandler->statusCodeFor($exception::class)
                )
            );
        }


    }

    private function exceptionCodeFor(Throwable $error): string
    {
        $domainErrorClass = DomainError::class;

        return $error instanceof $domainErrorClass
            ? $error->errorCode()
            : Utils::toSnakeCase($this->extractClassName($error));
    }

    private function extractClassName(object $object): string
    {
        $reflect = new ReflectionClass($object);

        return $reflect->getShortName();
    }
}
