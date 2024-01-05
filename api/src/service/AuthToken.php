<?php

namespace Kodemaster\Todo\service;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

class AuthToken
{
    public function __construct()
    {
    }

    public function generateToken($email, $id): false|string
    {
        $payload = [
            "exp" => time() + 600,
            "iat" => time(),
            "email" => $email,
            "id" => $id
        ];

        return JWT::encode($payload, $_ENV["KEY"], "HS256");
    }

    public function authToken($token)
    {
        try {
            $decoded = JWT::decode($token, new Key($_ENV["KEY"], "HS256"));
            return ["success" => true, "message" => "Token válido"];
        } catch (Exception $e) {
            return ["success" => false, "message" => "Token Inválido"];
        }
    }
}