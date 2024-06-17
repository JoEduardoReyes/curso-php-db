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
    // Preparar la consulta SQL para seleccionar todos los registros de la tabla incomes
    $stmt = $this->connection->prepare("SELECT amount, description FROM incomes");

    // Ejecutar la consulta preparada
    $stmt->execute();

    // Vincular las columnas 'amount' y 'description' a variables PHP
    $stmt->bindColumn('amount', $amount, PDO::PARAM_STR);
    $stmt->bindColumn('description', $description, PDO::PARAM_STR);

    // Recuperar y mostrar cada fila de resultados
    while ($stmt->fetch(PDO::FETCH_BOUND)) {
      // Imprimir los resultados vinculados
      echo "Ganaste: $amount USD en: $description \n";
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
  public function show($id): void
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
        echo "ID: {$income['id']}\n";
        echo "Método de pago: {$income['payment_method']}\n";
        echo "Tipo: {$income['type']}\n";
        echo "Fecha: {$income['date']}\n";
        echo "Monto: {$income['amount']}\n";
        echo "Descripción: {$income['description']}\n";
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
      // Iniciar una transacción
      $this->connection->beginTransaction();

      // Preparar la consulta de actualización
      $stmt = $this->connection->prepare("UPDATE incomes SET 
                payment_method = :payment_method,
                type = :type,
                date = :date,
                amount = :amount,
                description = :description
                WHERE id = :id");

      // Vincular parámetros para evitar SQL injection
      $stmt->bindParam(':payment_method', $data['payment_method'], \PDO::PARAM_INT);
      $stmt->bindParam(':type', $data['type'], \PDO::PARAM_INT);
      $stmt->bindParam(':date', $data['date'], \PDO::PARAM_STR);
      $stmt->bindParam(':amount', $data['amount'], \PDO::PARAM_STR);
      $stmt->bindParam(':description', $data['description'], \PDO::PARAM_STR);
      $stmt->bindParam(':id', $id, \PDO::PARAM_INT);

      // Ejecutar la consulta
      $stmt->execute();

      // Confirmar la transacción
      $this->connection->commit();

      echo "El registro con ID {$id} ha sido actualizado exitosamente.\n";
    } catch (PDOException $e) {
      // Revertir la transacción en caso de excepción
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
      $stmt->bindParam(':id', $id, \PDO::PARAM_INT);

      // Ejecutar la consulta
      $stmt->execute();

      // Confirmar con el usuario antes de proceder
      $sure = readline("De verdad quieres borrar este registro? (si/no): ");

      if (strtolower($sure) === "no") {
        // Revertir la transacción si el usuario no confirma
        $this->connection->rollBack();
        echo "Operación cancelada. No se eliminó el registro.\n";
      } else {
        // Confirmar la transacción
        $this->connection->commit();
        echo "El registro con ID {$id} ha sido eliminado exitosamente.\n";
      }

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