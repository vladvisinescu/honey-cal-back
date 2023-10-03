<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class ActionsGetController extends AbstractController
{
    public function __invoke()
    {
        return new JsonResponse([], 200);
    }
}
