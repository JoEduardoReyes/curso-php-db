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
      $this->controller = new IncomesController(); // No es necesario pasar la conexión aquí
    } catch (PDOException $e) {
      echo "Error al conectar a la base de datos: " . $e->getMessage();
      exit;
    }
  }

  public function run()
  {
    try {
      // Obtener la conexión PDO desde IncomesController
      $pdo_connection = $this->controller->get_connection();

      // Obtener el último registro de incomes
      $stmt = $pdo_connection->prepare("SELECT id FROM incomes ORDER BY id DESC LIMIT 1");
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($result) {
        $id = $result['id'];
        $this->controller->destroy($id);
      } else {
        echo "No hay registros de ingresos para eliminar.\n";
      }
    } catch (PDOException $e) {
      echo "Error al intentar obtener o eliminar el registro de ingreso: " . $e->getMessage();
    }
  }
}

$test = new TestDestroy();
$test->run();
