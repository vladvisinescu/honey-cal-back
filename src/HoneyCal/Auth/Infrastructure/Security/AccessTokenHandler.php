<?php

namespace HoneyCal\Auth\Infrastructure\Security;

use Exception;
use HoneyCal\Auth\Domain\AuthTokenRepository;
use Symfony\Component\Security\Http\AccessToken\AccessTokenHandlerInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;

class AccessTokenHandler implements AccessTokenHandlerInterface
{
    public function __construct(
        private AuthTokenRepository $tokenRepository
    ) {}

    public function getUserBadgeFrom(string $accessToken): UserBadge
    {
        $accessToken = $this->tokenRepository->findOneByValue($accessToken);

        if(!$accessToken || $accessToken->isExpired()) {
            throw new Exception('Invalid access token');
        }

        return new UserBadge($accessToken->userId()->value());
    }
}
