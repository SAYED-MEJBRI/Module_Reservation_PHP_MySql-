<?php 
class Database {
  private static $instance = null;
  private $conn;
  private $host = "localhost";  
  private $user = "root";
  private $pass = "";
  private $name = "espace_shambaya";
  private function __construct() {
    try {
      $this->conn = new PDO(
        "mysql:host={$this->host};dbname={$this->name}",
        $this->user,
        $this->pass
      );
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
      die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
  }
  public static function getInstance() {
    if(!self::$instance) {
      self::$instance = new Database();
    }
    return self::$instance;
  }
  public function getConnection() {
    return $this->conn;
  }
}


