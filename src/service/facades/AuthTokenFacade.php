<?php

namespace Kodemaster\Todo\service\facades;

use Kodemaster\Todo\service\AuthToken;

class AuthTokenFacade
{
    public static function generateToken($email, $id): false|string
    {
        $authToken = new AuthToken();
        return $authToken->generateToken($email, $id);
    }

    public static function authToken($token): array
    {
        $authToken = new AuthToken();
        return $authToken->authToken($token);
    }
}