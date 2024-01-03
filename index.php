<?php
require_once "./vendor/autoload.php";

use CoffeeCode\Router\Router;
use Dotenv\Dotenv;


$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new Router($_ENV["SITE_URL"]);

$router->group("api/v1")->namespace("Kodemaster\\Todo\\application\\controllers");
$router->get("/", "BaseController:index", "home");

$router->group("api/auth")->namespace("Kodemaster\\Todo\\application\\controllers\\auth");
$router->get("/token", "AuthController:index", "auth.token");

$router->group("api/v1", Kodemaster\Todo\framework\web\middleware\AuthenticationMiddleware::class)->namespace("Kodemaster\\Todo\\application\\controllers\\api");

$router->dispatch();

if ($router->error()) {
    $router->redirect("name . hello");
}
