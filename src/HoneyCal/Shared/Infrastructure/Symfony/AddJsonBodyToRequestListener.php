<?php

namespace HoneyCal\Shared\Infrastructure\Symfony;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class AddJsonBodyToRequestListener
{
    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();
        $requestContents = $request->getContent();

        if (!($requestContents && $this->containsHeader($request, 'Content-Type', 'application/json'))) {
            /** @var array */
            $jsonData = json_decode($requestContents, true, 512, JSON_THROW_ON_ERROR);

            if (!$jsonData) {
                throw new HttpException(Response::HTTP_BAD_REQUEST, 'Invalid json data');
            }
            $jsonDataLowerCase = [];
            foreach ($jsonData as $key => $value) {
                $string = preg_replace_callback(
                    '/_(.)/',
                    static fn ($matches) => strtoupper($matches[1]),
                    $key
                );
                $jsonDataLowerCase[$string] = $value;
            }

            $request->request->replace($jsonDataLowerCase);
        }
    }

    private function containsHeader(Request $request, string $name, string $value): bool
    {
        return str_starts_with((string) $request->headers->get($name), $value);
    }
}
