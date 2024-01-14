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
    }

    public function index()
    {
    }

    public function login($data)
    {
        try {
            $formData = json_decode(file_get_contents("php://input"), true);
            if (!isset($formData["email"]) || !isset($formData["password"])) {
                throw new Exception();
            }
            $email = filter_var($formData["email"], FILTER_SANITIZE_EMAIL);
            $password = filter_var($formData["password"], FILTER_SANITIZE_SPECIAL_CHARS);
            $data = AuthLoginFacade::login($email, $password);
            if ($data) {
                $user = $data["data"];
                $token = AuthTokenFacade::generateToken($user["email"], $user["id"]);
                $cookie_options = ['expires' => time() + 1800,
                    'path' => '/',
                    'domain' => 'localhost',
                    'secure' => true,
                    'httponly' => true,
                    'samesite' => 'Strict'
                ];
                if(isset($_SERVER['HTTP_REFERER']) && parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) === $_ENV["BASE_URL"]) {
                    setcookie("tkn", $token, $cookie_options);
                }
                if (isset($_SERVER['HTTP_ORIGIN']) && $_SERVER['HTTP_ORIGIN'] === $_ENV["BASE_URL"]) {
                    setcookie("tkn", $token, $cookie_options);
                }
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