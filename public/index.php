<?php

require("../vendor/autoload.php");

use App\Controllers\IncomesController;
use App\Controllers\WithdrawalsController;
use Router\RouterHandler;

// Obtener la URL
$slug = $_GET["slug"] ?? "";
$slug = explode("/", $slug);

$resource = $slug[0] == "" ? "/" : $slug[0];
$id = $slug[1] ?? null;

// Intancia del router

$router = new RouterHandler();

switch ($resource) {

  case '/':
    echo "Estás en la front page";
    break;

  case "incomes":

    $method = $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['_method']) ? strtolower($_POST['_method']) : strtolower($_SERVER['REQUEST_METHOD']);
    $router->set_method($method);
    $router->set_data($_POST);
    $router->route(IncomesController::class, $id);

    break;

  case "withdrawals":

    $method = $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['_method']) ? strtolower($_POST['_method']) : strtolower($_SERVER['REQUEST_METHOD']);
    $router->set_method($method);
    $router->set_data($_POST);
    $router->route(WithdrawalsController::class, $id);

    break;

  default:
    echo "404 Not Found";
    break;

}
