<?php

namespace Database\MySQLi;

class Connection
{
  private static $instance;
  private $connection;
  private const SERVER = "localhost";
  private const DATABASE = "finanzas_personales";
  private const USERNAME = "joedu";
  private const PASSWORD = "toor";

  private function __construct()
  {
    throw new \RuntimeException("No se debe instanciar la clase Connection directamente. Use Connection::getInstance()");
  }

  public static function getInstance(): Connection
  {
    if (!self::$instance) {
      self::$instance = new self();
      self::$instance->makeConnection();
    }

    return self::$instance;
  }

  public function getDataBaseInstance(): mysqli
  {
    return $this->connection;
  }

  private function makeConnection(): void
  {
    try {
      $this->connection = new mysqli(
        self::SERVER,
        self::USERNAME,
        self::PASSWORD,
        self::DATABASE
      );

      if ($this->connection->connect_error) {
        throw new \RuntimeException("Falló la conexión: {$this->connection->connect_error}");
      }
    } catch (\Throwable $e) {
      throw new \RuntimeException("Error al conectar a la base de datos: {$e->getMessage()}");
    }
  }
}
