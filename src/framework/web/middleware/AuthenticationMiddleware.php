<?php

namespace Kodemaster\Todo\framework\web\middleware;

use CoffeeCode\Router\Router;
use Exception;
use Kodemaster\Todo\service\facades\AuthTokenFacade;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationMiddleware
{
    private Response $response;

    public function __construct()
    {
        $this->response = new Response();
    }

    public function handle(Router $router)
    {
        try {
            $request_headers = getallheaders();
            $data = AuthTokenFacade::authToken(str_replace("Bearer ", "", $request_headers["Authorization"]));
            if ($data["success"]) {
                return true;
            } else {
                throw new Exception("Unauthorized");
            }
        } catch (Exception $e) {
            $this->response->headers->set("Content-Type", "application/json");
            $this->response->setStatusCode(401);
            $this->response->send();
            return false;
        }
    }
}