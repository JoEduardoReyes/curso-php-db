<?php

require("../vendor/autoload.php");

use App\Controllers\IncomesController;
use App\Controllers\WithdrawalsController;
use Router\RouterHandler;

// Obtener la URL
$slug = $_SERVER["REQUEST_URI"] ?? "/";
$slug = explode("/", $slug);

$resource = $slug[1] ?? "/";
$id = $slug[3] ?? null;

// Instancia del router
$router = new RouterHandler();

switch ($resource) {
  case '/':
    echo "Estás en la página de inicio";
    break;

  case "incomes":
    if ($id && is_numeric($id)) {
      $router->set_method("get");
      $router->route(IncomesController::class, $id);
    } else {
      $method = $_POST["method"] ?? "get";
      $router->set_method($method);
      $router->set_data($_POST);
      $router->route(IncomesController::class, $id);
    }
    break;

  case "withdrawals":
    $method = $_POST["method"] ?? "get";
    $router->set_method($method);
    $router->set_data($_POST);
    $router->route(WithdrawalsController::class, $id);
    break;

  default:
    echo "404 Not Found";
    break;
}
