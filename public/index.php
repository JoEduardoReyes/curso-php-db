<?php

require('../vendor/autoload.php');

// Obtener URL
$slug = $_GET['slug'] ?? "";
$slug = explode("/", $slug);

$resource = $slug[0] == "" ? "/" : $slug[0];
$id = $slug[1] ?? null;

switch ($resource) {
  case "/":
    echo "Estas en la fromt page";
    break;
  case "incomes":
    echo "Estas con incomes";
    break;
  case "widthdraws":
    echo "Estas con widthdraws";
    break;
  default:
    echo "404 Not found";
    break;
}