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
        $firstName = (string) $request->query->get('first_name');
        $lastName = (string) $request->query->get('last_name');
        $email = (string) $request->query->get('email');
        $password = (string) $request->query->get('password');

        $this->dispatch(
            new RegisterUserCommand($firstName, $lastName, $email, $password)
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
            'first_name' => [],
            'last_name' => [],
            'email' => [],
            'password' => [],
        ];
    }
}
