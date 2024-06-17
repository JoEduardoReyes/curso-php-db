<?php

namespace App\Controllers;

use Database\PDO\Connection;
use PDO;

class WithdrawalsController
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
    $stmt = $this->connection->prepare("SELECT * FROM withdrawals");

    $stmt->execute();

    $results = $stmt->fetchAll();

    foreach ($results as $result) {
      echo "Gastaste " . $result["amount"] . " USD en: " . $result["description"] . "\n";
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
  public function store($data)
  {


    $stmt = $this->connection->prepare("INSERT INTO withdrawals (payment_method, type, date, amount, description) VALUES (
                                                                                  :payment_method,
                                                                                  :type,
                                                                                  :date,
                                                                                  :amount,
                                                                                  :description
    )");

    $stmt->bindValue(':payment_method', $data['payment_method']);
    $stmt->bindValue(':type', $data['type']);
    $stmt->bindValue(':date', $data['date']);
    $stmt->bindValue(':amount', $data['amount']);
    $stmt->bindValue(':description', $data['description']);

    $stmt->execute();


  }

  /**
   * Muestra un único recurso especificado
   */
  public function show($id)
  {
    $stmt = $this->connection->prepare("SELECT * FROM withdrawals WHERE id = :id");
    $stmt->execute(array(":id" => $id));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    echo "el registro con id: $id dice que te gastaste {$result['amount']} USD en: " . $result["description"] . "\n";
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
  public function destroy()
  {
  }

}