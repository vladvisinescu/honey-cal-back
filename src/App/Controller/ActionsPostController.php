<?php

namespace App\Controller;

use HoneyCal\Habits\Application\Create\CreateActionCommand;
use HoneyCal\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class ActionsPostController extends ApiController
{
    public function __invoke(Request $request)
    {
        $this->dispatch(
            new CreateActionCommand(
                title: $request->query->get('title'),
                description: $request->query->get('description'),
                recurrence: $request->query->all()['recurrence'],
            )
        );

        return new JsonResponse(
            ['success' => true, 'message' => 'Action created successfully'],
            JsonResponse::HTTP_CREATED,
            ['Access-Control-Allow-Origin' => '*']
        );
    }

        protected function exceptions(): array
    {
        return [];
    }
}
