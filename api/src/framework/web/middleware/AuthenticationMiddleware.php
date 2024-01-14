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
        $this->response->headers->set("Content-Type", "application/json");
        $this->response->headers->set("Access-Control-Allow-Origin", "http://localhost:5173");
        $this->response->headers->set("Access-Control-Allow-Methods", "GET, POST, OPTIONS, PUT, PATCH, DELETE");
        $this->response->headers->set("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
    }

    public function handle(Router $router): bool
    {
        try {
            $request_headers = getallheaders();
            $token = "";
            if (isset($_COOKIE["tkn"])) {
                $token = $_COOKIE["tkn"];
            } else if (isset($request_headers["Authorization"])) {
                $token = $request_headers["Authorization"];
            } else {
                throw new Exception();
            }
            $data = AuthTokenFacade::authToken(str_replace("Bearer ", "", $token));
            if ($data["success"]) {
                return true;
            } else {
                throw new Exception("Unauthorized");
            }
        } catch (Exception $e) {
            $this->response->setStatusCode(401);
            $this->response->send();
            return false;
        }
    }
}