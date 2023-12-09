<?php

namespace HoneyCal\Auth\Infrastructure\Security;

use HoneyCal\Auth\Domain\AuthTokenRepository;
use Symfony\Component\Security\Http\AccessToken\AccessTokenHandlerInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;

class AccessTokenHandler implements AccessTokenHandlerInterface
{
    public function __construct(
        private AuthTokenRepository $tokenRepository
    ) {}

    public function getUserBadgeFrom(string $authToken): UserBadge
    {
        $authToken = $this->tokenRepository->findOneByValue($authToken);

        if(!$authToken || $authToken->isExpired()) {
            throw new \Exception('Invalid access token');
        }

        return new UserBadge($authToken->userId()->value());
    }
}
