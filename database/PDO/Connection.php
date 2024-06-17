<?php

namespace Database\PDO;

use PDO;
use PDOException;
use Dotenv\Dotenv;

require_once(__DIR__ . '/../../vendor/autoload.php');

class Connection {

  private static $instance;
  private $connection;

  private function __construct() {
    $this->make_connection();
  }

  public static function getInstance(): Connection
  {
    if (!self::$instance instanceof self) {
      self::$instance = new self();
    }

    return self::$instance;
  }

  public function get_database_instance() {
    return $this->connection;
  }

  private function make_connection(): void
  {
    // Cargar variables de entorno desde el archivo .env
    $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
    $dotenv->load();

    // Obtener variables de entorno
    $server = $_ENV['DB_HOST'];
    $database = $_ENV['DB_NAME'];
    $username = $_ENV['DB_USER'];
    $password = $_ENV['DB_PASS'];

    try {
      // Crear la conexión PDO
      $this->connection = new PDO("mysql:host=$server;dbname=$database", $username, $password);

      // Establecer el modo de errores a excepción
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // Establecer el conjunto de caracteres a UTF-8
      $setnames = $this->connection->prepare("SET NAMES 'utf8'");
      $setnames->execute();
    } catch (PDOException $e) {
      throw new PDOException($e->getMessage(), (int)$e->getCode());
    }
  }
}
