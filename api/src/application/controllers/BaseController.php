<?php

namespace Kodemaster\Todo\application\controllers;

use CoffeeCode\Router\Router;
use Kodemaster\Todo\service\facades\AuthTokenFacade;
use Symfony\Component\HttpFoundation\Response;

class BaseController
{

    protected Router $router;
    protected Response $response;

    public function __construct($router)
    {
        $this->router = $router;
        $this->response = new Response();
    }

    public function index()
    {
    }
}