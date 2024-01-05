<?php
require_once "./vendor/autoload.php";

use CoffeeCode\Router\Router;
use Dotenv\Dotenv;


$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new Router($_ENV["SITE_URL"]);

$router->group("/auth")->namespace("Kodemaster\\Todo\\application\\controllers\\auth");
$router->post("/login", "AuthController:login", "auth.login");

$router->group("/v1", Kodemaster\Todo\framework\web\middleware\AuthenticationMiddleware::class)->namespace("Kodemaster\\Todo\\application\\controllers\\api");
$router->get("/dashboard", "DashboardController:index", "dashboardData");

$router->dispatch();

if ($router->error()) {
    $router->redirect("name . hello");
}
