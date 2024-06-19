<?php

require_once 'vendor/autoload.php';

use App\Controllers\IncomesController;

class TestDestroy
{
  private $controller;

  public function __construct()
  {
    // Configura la conexión a la base de datos
    $dsn = 'mysql:host=localhost;dbname=finanzas_personales;charset=utf8';
    $username = 'joedu';
    $password = 'toor';

    try {
      $connection = new PDO($dsn, $username, $password);
      $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->controller = new IncomesController($connection);
    } catch (PDOException $e) {
      echo "Error al conectar a la base de datos: " . $e->getMessage();
      exit;
    }
  }

  public function run()
  {
    $id = readline("Ingrese el ID del registro que desea eliminar: ");
    $this->controller->destroy($id);
  }
}

$test = new TestDestroy();
$test->run();
