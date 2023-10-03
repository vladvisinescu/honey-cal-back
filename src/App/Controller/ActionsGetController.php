<?php

namespace App\Controller;

use HoneyCal\Habits\Application\Create\CreateActionCommand;
use HoneyCal\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ActionsGetController extends ApiController
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

        return new JsonResponse([], 200);
    }

    protected function exceptions(): array
    {
        return [];
    }
}
