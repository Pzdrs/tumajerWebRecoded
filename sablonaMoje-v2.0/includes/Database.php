<?php


class Database {

  private static $instance;

  private $connection;

  private $hostname = 'localhost';

  private $username = 'admin';

  private $password = 'admin';

  private $database = 'sablonaMoje';

  private function __construct() {
    try {
      $this->connection = new PDO('mysql:host=' . $this->hostname . ';dbname='
        . $this->database, $this->username, $this->password);
    } catch (PDOException $exception) {
      echo 'Failed to establish connection: ' . $exception->getMessage();
    }
  }

  public static function getInstance() {
    if (self::$instance == NULL) {
      self::$instance = new Database();
    }
    return self::$instance;
  }

  public function getConnection() {
    return $this->connection;
  }

}