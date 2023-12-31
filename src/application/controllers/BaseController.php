<?php

namespace Kodemaster\Todo\application\controllers;

class BaseController
{

    private $router;

    public function __construct($router)
    {
        $this->router = $router;
    }

    public function index($data)
    {
        var_dump($this->router, $data);
    }
}