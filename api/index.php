<?php
require_once "./vendor/autoload.php";

use CoffeeCode\Router\Router;
use Dotenv\Dotenv;
use Kodemaster\Todo\framework\web\middleware\AuthenticationMiddleware;
use Kodemaster\Todo\application\controllers\ErrorController;
use Symfony\Component\HttpFoundation\Response;


$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    $response = new Response();
    $response->headers->set("Access-Control-Allow-Origin", "http://localhost");
    $response->headers->set("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
    $response->headers->set("Access-Control-Allow-Methods", "GET, POST, OPTIONS, PUT, PATCH, DELETE");
    $response->headers->set("Access-Control-Allow-Credentials" , "true");
    $response->headers->set("Content-Type", "application/json");
    $response->send();
    exit();
}

$router = new Router($_ENV["SITE_URL"]);
$router->group("/auth")->namespace("Kodemaster\\Todo\\application\\controllers\\auth");
$router->get("/index", "AuthController:index");
$router->post("/login", "AuthController:login", "auth.login");

$router->group("/v1", AuthenticationMiddleware::class)->namespace("Kodemaster\\Todo\\application\\controllers\\api");
$router->get("/dashboard", "DashboardController:index", "dashboardData");

$router->group("/ops")->namespace(ErrorController::class);
$router->get("/{errcode}", "Error:err", "error.err");

$router->dispatch();

if ($router->error()) {
    $router->redirect("/ops/{$router->error()}");
}
