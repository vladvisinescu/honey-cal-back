<?php

namespace App\Controller\Auth;

use HoneyCal\Auth\Application\Register\RegisterUserCommand;
use HoneyCal\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class AuthRegisterController extends ApiController
{

    public function __invoke(
        Request $request
    ) {
        $email = (string) $request->request->get('email');
        $password = (string) $request->request->get('password');

        $this->dispatch(
            new RegisterUserCommand($email, $password)
        );

        return new JsonResponse([], Response::HTTP_CREATED);
    }

    protected function exceptions(): array
    {
        return [
            //
        ];
    }

    protected function validationConstraints(): array
    {
        return [
            'email' => [],
            'password' => [],
        ];
    }
}
