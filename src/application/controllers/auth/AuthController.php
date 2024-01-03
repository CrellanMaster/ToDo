<?php

namespace Kodemaster\Todo\application\controllers\auth;

use Kodemaster\Todo\application\controllers\BaseController;
use Kodemaster\Todo\service\facades\AuthTokenFacade;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends BaseController
{

    public function index()
    {
        $token = AuthTokenFacade::generateToken("Sandro@gmail.com", 1);
        var_dump($token);
        var_dump(AuthTokenFacade::authToken($token), $this->router);
    }

}