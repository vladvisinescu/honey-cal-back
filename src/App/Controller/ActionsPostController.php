<?php

namespace App\Controller;

use HoneyCal\Habits\Application\Create\CreateActionCommand;
use HoneyCal\Habits\Domain\Recurrence;
use HoneyCal\Shared\Infrastructure\Symfony\ApiController;
use HoneyCal\Shared\Infrastructure\Validator\RequestValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NoSuspiciousCharacters;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Valid;

final class ActionsPostController extends ApiController
{
    public function __invoke(Request $request)
    {
        $this->dispatch(
            new CreateActionCommand(
                title: (string) $request->query->get('title'),
                description: (string) $request->query->get('description'),
                recurrence: (array) $request->query->all()['recurrence'],
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
        return [
            RequestValidationException::class => JsonResponse::HTTP_BAD_REQUEST,
        ];
    }

    protected function validationConstraints(): array
    {
        return [
            'title' => [new NotBlank(), new Length(['min' => 1, 'max' => 1]), new NoSuspiciousCharacters()],
            'description' => [new Length(['min' => 1, 'max' => 2000]), new NoSuspiciousCharacters()],
            'recurrence' =>  new Collection([
                'every' => [new NotBlank(), new Choice(Recurrence::getConstants()['EVERY'])],
                'on' => [new Choice(Recurrence::getConstants()['ON'])],
                'at' => [new NoSuspiciousCharacters()],
                'starting' => [new Date()],
                'ending' => [new Date()],
            ]),
        ];
    }
}
