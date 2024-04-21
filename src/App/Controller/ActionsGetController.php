<?php

namespace App\Controller;

use HoneyCal\Habits\Application\SearchAll\SearchAllActionsQuery;
use HoneyCal\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class ActionsGetController extends ApiController
{
    public function __invoke(Request $request): JsonResponse
    {
        $response = $this->ask(
            new SearchAllActionsQuery()
        );

        return new JsonResponse(
            $response,
            Response::HTTP_OK,
            ['Access-Control-Allow-Origin' => '*']
        );
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
