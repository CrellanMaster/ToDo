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
        $this->response->headers->set("Access-Control-Allow-Origin", "http://localhost");
        $this->response->headers->set("Access-Control-Allow-Methods", "GET, POST, OPTIONS, PUT, PATCH, DELETE");
        $this->response->headers->set("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
        $this->response->headers->set("Access-Control-Allow-Credentials" , "true");
        $this->response->headers->set("Content-type", "application/json");
    }

    public function index()
    {
    }
}