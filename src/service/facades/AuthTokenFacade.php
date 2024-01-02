<?php

namespace Kodemaster\Todo\service\facades;

use Kodemaster\Todo\service\AuthToken;

class AuthTokenFacade
{
    public static function generateToken($email): false|string
    {
        $authToken = new AuthToken();
        return $authToken->generateToken($email);
    }

}