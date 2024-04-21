<?php

namespace App\Controller;

use HoneyCal\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;

final class ActionsGetOneController extends ApiController
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse([]);
    }

    protected function exceptions(): array
    {
        return [];
    }

    protected function validationConstraints(): array
    {
        return [];
    }
}
