<?php

namespace HoneyCal\Shared\Infrastructure\Validator;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

final class RequestErrorResponse
{
    public static function from(ExceptionEvent $event, int $statusCode): void
    {
        /* @var Exception $exception */
        $exception = $event->getThrowable();

        $event->setResponse(
            new JsonResponse(
                [
                    'code' => 'request_error',
                    'message' => $exception->getMessage(),
                ],
                $statusCode
            )
        );
    }
}
