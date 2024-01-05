<?php

namespace Kodemaster\Todo\service\facades;

use Kodemaster\Todo\service\AuthLogin;

class AuthLoginFacade
{
    public static function login($email, $password)
    {
        $authLogin = new AuthLogin();
        return $authLogin->login($email, $password);
    }
}