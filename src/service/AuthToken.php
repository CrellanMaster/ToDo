<?php

namespace Kodemaster\Todo\service;

use Firebase\JWT\JWT;

class AuthToken
{
    public function __construct()
    {
    }

    public function generateToken($email): false|string
    {
        $payload = [
            "exp" => time() + 600,
            "iat" => time(),
            "email" => $email
        ];

        $encode = JWT::encode($payload, $_ENV["KEY"], "HS256");
        return json_encode($encode);
    }
}