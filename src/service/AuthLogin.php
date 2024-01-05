<?php

namespace Kodemaster\Todo\service;

use Exception;
use Kodemaster\Todo\application\models\entities\UserModel;

class AuthLogin
{

    public function login($email, $password)
    {
        try {
            $userModel = new UserModel();
            $user = $userModel->selectByEmail($email);
            if ($user) {
                if (password_verify($password, $user["password"])) {
                    return ["success" => true, "message" => "Sucesso", "data" => $user];
                } else {
                    throw new Exception("Usuário ou senha incorretos");
                }
            } else {
                throw new Exception("Usuário ou senha incorretos");
            }
        } catch (Exception $e) {
            return false;
        }
    }
}