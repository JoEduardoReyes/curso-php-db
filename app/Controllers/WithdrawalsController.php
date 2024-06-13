<?php

namespace App\Controllers;

use Database\PDO\Connection;
use PDO;

class WithdrawalsController
{

  private $connection;

  public function __construct() {
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