<?php

namespace App\Controller;

use HoneyCal\Habits\Application\SearchAll\SearchAllActionsQuery;
use HoneyCal\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class ActionsGetController extends ApiController
{
    public function __invoke(Request $request)
    {
        $response = $this->ask(
            new SearchAllActionsQuery()
        );

        return new JsonResponse(
            $response,
            JsonResponse::HTTP_OK,
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
