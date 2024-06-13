<?php

namespace App\Controllers;

use Database\PDO\Connection;
use PDO;
use PDOException;

class IncomesController
{
  private $connection;

  public function __construct()
  {
    $this->connection = Connection::getInstance()->get_database_instance();
  }

  /**
   * Muestra una lista de este recurso
   */
  public function index()
  {
    $stmt = $this->connection->prepare("SELECT * FROM incomes");
    $stmt->execute();

    while ($row = $stmt->fetch()) {
      echo "Ganaste: " . $row["amount"] . " USD en: " . $row["description"] . "\n";
    }
  }

  /**
   * Muestra un formulario para crear un nuevo recurso
   */
  public function create()
  {
  }

  /**
   * Guarda un nuevo recurso en la base de datos
   */
  public function store($data): void
  {
    // Obtener los datos del arreglo $data
    $payment_method = $data['payment_method'];
    $type = $data['type'];
    $date = $data['date'];
    $amount = $data['amount'];
    $description = $data['description'];

    try {
      // Obtener una instancia de la conexión PDO
      $connection = Connection::getInstance()->get_database_instance();

      // Consulta SQL preparada con marcadores de posición
      $sql = "INSERT INTO incomes (payment_method, type, date, amount, description) VALUES (?, ?, ?, ?, ?)";

      // Preparar la consulta
      $stmt = $connection->prepare($sql);

      // Vincular parámetros con bindValue (PDO::PARAM_*)
      $stmt->bindValue(1, $payment_method, PDO::PARAM_INT);
      $stmt->bindValue(2, $type, PDO::PARAM_INT);
      $stmt->bindValue(3, $date, PDO::PARAM_STR);
      $stmt->bindValue(4, $amount, PDO::PARAM_STR); // o \PDO::PARAM_INT si amount es un entero
      $stmt->bindValue(5, $description, PDO::PARAM_STR);

      // Ejecutar la consulta
      $stmt->execute();

      // Obtener el número de filas afectadas
      $affected_rows = $stmt->rowCount();
      echo "Se han insertado $affected_rows filas en la base de datos.";
    } catch (PDOException $e) {
      echo "Error al insertar en la base de datos: " . $e->getMessage();
    }
  }

  /**
   * Muestra un único recurso especificado
   */
  public function show()
  {
  }

  /**
   * Muestra el formulario para editar un recurso
   */
  public function edit()
  {
  }

  /**
   * Actualiza un recurso específico en la base de datos
   */
  public function update()
  {
  }

  /**
   * Elimina un recurso específico de la base de datos
   */
  public function destroy()
  {
  }

}

/*

index - Display a listing of the resource.
create - Show the form for creating a new resource.
store - Store a newly created resource in storage.
show - Display the specified resource.
edit - Show the form for editing the specified resource.
update - Update the specified resource in storage.
destroy - Remove the specified resource from storage.

*/