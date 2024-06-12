<?php

namespace Databse\PDO;

class Connection
{
  private static $instance;
  private $pdo;
  private const SERVER = "localhost";
  private const DATABASE = "finanzas_personales";
  private const USERNAME = "joedu";
  private const PASSWORD = "toor";

  private function __construct()
  {
    $this->connect();
  }

  public static function getInstance(): Connection
  {
    if (!self::$instance) {
      self::$instance = new self();
    }

    return self::$instance;
  }

  public function getPdo(): PDO
  {
    return $this->pdo;
  }

  private function connect(): void
  {
    try {
      $this->pdo = new PDO(
        "mysql:host=" . self::SERVER . ";dbname=" . self::DATABASE,
        self::USERNAME,
        self::PASSWORD
      );
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->pdo->exec("SET NAMES 'utf8'");
    } catch (\PDOException $e) {
      throw new \RuntimeException("Error al conectar a la base de datos: {$e->getMessage()}");
    }
  }
}