<?php

namespace Kodemaster\Todo\application\controllers\api;

use Kodemaster\Todo\application\controllers\BaseController;

class DashboardController extends BaseController
{
    public function __construct($router)
    {
        parent::__construct($router);
        $this->response->headers->set("Content-type", "application/json");
    }

    public function index()
    {
        $this->response->setStatusCode(200);
        $this->response->setContent(json_encode(["data" => "vários dados"]));
        $this->response->send();
    }
}