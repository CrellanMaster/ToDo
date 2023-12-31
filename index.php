<?php
require_once "./vendor/autoload.php";

use CoffeeCode\Router\Router;
use Dotenv\Dotenv;


$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new Router($_ENV["SITE_URL"]);

$router->namespace("Kodemaster\\Todo\\application\\controllers");
$router->get("/", "BaseController:index", "home");

$router->dispatch();

if ($router->error()) {
    $router->redirect("name.hello");
}
