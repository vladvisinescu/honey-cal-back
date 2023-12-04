<?php

namespace HoneyCal\Shared\Infrastructure\Validator;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Validator\ConstraintViolation;

use function Lambdish\Phunctional\map;

final class ValidationErrorResponse
{
    public static function from(ExceptionEvent $event, int $statusCode): void
    {
        /* @var RequestValidationException $exception */
        $exception = $event->getThrowable();

        $event->setResponse(
            new JsonResponse(
                [
                    'code' => 'validation_error',
                    'message' => 'The input contains input errors.',
                    'errors' => map(
                        fn (ConstraintViolation $error) => [
                            'field' => $error->getPropertyPath(),
                            'message' => $error->getMessage(),
                        ],
                        $exception->errors()
                    )
                ],
                $statusCode
            )
        );
    }
}
