<?php

namespace Kodemaster\Todo\application\controllers;

use CoffeeCode\Router\Router;
use Kodemaster\Todo\service\facades\AuthTokenFacade;

class BaseController
{

    protected Router $router;

    public function __construct($router)
    {
        $this->router = $router;
    }

    public function index()
    {
        var_dump($this->router);

    }
}