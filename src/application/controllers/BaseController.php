<?php

namespace Kodemaster\Todo\application\controllers;

use Kodemaster\Todo\service\facades\AuthTokenFacade;

class BaseController
{

    private $router;

    public function __construct($router)
    {
        $this->router = $router;
    }

    public function index($data)
    {

    }
}