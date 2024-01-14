<?php

namespace Kodemaster\Todo\application\controllers;

use Kodemaster\Todo\application\controllers\BaseController;

class ErrorController extends BaseController
{
    public function __construct($router)
    {
        parent::__construct($router);
    }

    public function err($data)
    {
        $this->response->setStatusCode($data["errcode"]);
        $this->response->send();
    }
}