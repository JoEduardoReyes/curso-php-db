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

  public function get_connection()
  {
    return $this->connection;
  }
  /**
   * Muestra una lista de este recurso
   */
  public function index()
  {
    try {
      $stmt = $this->connection->prepare("SELECT * FROM incomes");
      $stmt->execute();
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
      require("../resources/views/incomes/index.php");

    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }

  /**
   * Muestra un formulario para crear un nuevo recurso
   */
  public function create()
  {
    require("../resources/views/incomes/create.php");
  }

  /**
   * Guarda un nuevo recurso en la base de datos
   */
  public function store($data): void
  {
    // Obtener los datos del arreglo $data
    $payment_method = $data['payment_method'];
    $type = $data['type'];
    $date = $data['datetime'];  // Obtener la fecha y hora combinadas desde el campo oculto
    $amount = $data['amount'];
    $description = $data['description'];

    // Verificar el formato de la fecha
    if (preg_match('/\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}/', $date) !== 1) {
      echo "Formato de fecha inválido: $date";
      return;
    }

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
      $stmt->bindValue(4, $amount, PDO::PARAM_INT);
      $stmt->bindValue(5, $description, PDO::PARAM_STR);

      // Ejecutar la consulta
      $stmt->execute();

      // Obtener el número de filas afectadas
      $affected_rows = $stmt->rowCount();
      echo "Se han insertado $affected_rows filas en la base de datos.";
    } catch (PDOException $e) {
      echo "Error al insertar en la base de datos: " . $e->getMessage();
    }
    header("Location: /incomes");
  }




  /**
   * Muestra un único recurso especificado
   */
  public function show($id)
  {
    try {
      // Preparar la consulta para seleccionar un registro por ID
      $stmt = $this->connection->prepare("SELECT * FROM incomes WHERE id = :id");

      // Vincular el parámetro ID para evitar SQL injection
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);

      // Ejecutar la consulta
      $stmt->execute();

      // Obtener el resultado como un array asociativo
      $income = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($income) {
        require("../resources/views/incomes/show.php"); // Asegúrate de que esta vista exista
      } else {
        echo "No se encontró el registro con ID $id.\n";
      }

    } catch (PDOException $e) {
      // Manejar errores y excepciones
      echo "Error al intentar mostrar el registro: " . $e->getMessage();
    }
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
  public function update($id, $data): void
  {
    try {
      $this->connection->beginTransaction();

      $stmt = $this->connection->prepare("UPDATE incomes SET 
                  payment_method = :payment_method,
                  type = :type,
                  date = :date,
                  amount = :amount,
                  description = :description
                  WHERE id = :id");

      $stmt->bindParam(':payment_method', $data['payment_method'], PDO::PARAM_INT);
      $stmt->bindParam(':type', $data['type'], PDO::PARAM_INT);
      $stmt->bindParam(':date', $data['datetime'], PDO::PARAM_STR); // Asegúrate de usar 'datetime'
      $stmt->bindParam(':amount', $data['amount'], PDO::PARAM_STR);
      $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);

      $stmt->execute();

      $this->connection->commit();

      header("Location: /incomes/$id");
    } catch (PDOException $e) {
      $this->connection->rollBack();
      echo "Error al intentar actualizar el registro: " . $e->getMessage();
    }
  }


  /**
   * Elimina un recurso específico de la base de datos
   */
  public function destroy($id): void
  {
    try {
      // Iniciar una transacción
      $this->connection->beginTransaction();

      // Preparar la consulta de eliminación
      $stmt = $this->connection->prepare("DELETE FROM incomes WHERE id = :id");

      // Vincular el parámetro ID para evitar SQL injection
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);

      // Ejecutar la consulta
      $stmt->execute();

      // Confirmar la transacción
      $this->connection->commit();

      echo "El registro con ID {$id} ha sido eliminado exitosamente.\n";

    } catch (PDOException $e) {
      // Revertir la transacción en caso de excepción
      $this->connection->rollBack();
      echo "Error al intentar eliminar el registro: " . $e->getMessage();
    }
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