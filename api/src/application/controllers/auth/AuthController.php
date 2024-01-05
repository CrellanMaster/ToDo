<?php

namespace Kodemaster\Todo\application\controllers\auth;

use Http\User;
use Kodemaster\Todo\application\controllers\BaseController;
use Kodemaster\Todo\application\models\entities\UserModel;
use Kodemaster\Todo\service\facades\AuthLoginFacade;
use Kodemaster\Todo\service\facades\AuthTokenFacade;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class AuthController extends BaseController
{

    public function __construct($router)
    {
        parent::__construct($router);
        $this->response->headers->set("Content-type", "application/json");
    }

    public function index()
    {
    }

    public function login()
    {
        try {
            if (!isset($_POST["email"]) || !isset($_POST["password"])) {
                throw new Exception();
            }
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
            $data = AuthLoginFacade::login($email, $password);
            if ($data) {
                $user = $data["data"];
                $token = AuthTokenFacade::generateToken($user["email"], $user["id"]);
                $this->response->setStatusCode(200);
                $this->response->setContent(json_encode(["success" => true, "token" => $token], JSON_PRETTY_PRINT));
            } else {
                $this->response->setStatusCode(400);
            }
            $this->response->send();
        } catch (Exception $e) {
            $this->response->setStatusCode(500);
            $this->response->send();
        }
    }
}