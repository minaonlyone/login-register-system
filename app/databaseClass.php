<?php
class DB {
  
  private $pdo = null;
  private $stmt = null;
  public $error;


  function __construct () {
    try {
      $this->pdo = new PDO(
        "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET,
        DB_USER, DB_PASSWORD, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
      ]);
    } catch (Exception $ex) { exit($ex->getMessage()); }
  }
 
  function __destruct () {
    if ($this->stmt !== null) { $this->stmt = null; }
    if ($this->pdo !== null) { $this->pdo = null; }
  }
 
  function exec ($sql, $data=null) {
    try {
      $this->stmt = $this->pdo->prepare($sql);
      $this->stmt->execute($data);
      return true;
    } catch (Exception $ex) {
      $this->error = $ex->getMessage();
      return false;
    }
  }
 
  function fetch ($sql, $data=null) {
    if ($this->exec($sql, $data) === false) { return false; }
    return $this->stmt->fetch();
  }
 
  function fetchAll ($sql, $data=null) {
    if ($this->exec($sql, $data) === false) { return false; }
    return $this->stmt->fetchAll();
  }
}
 
define("DB_HOST", "localhost");
define("DB_NAME", "login");
define("DB_CHARSET", "utf8");
define("DB_USER", "root");
define("DB_PASSWORD", "");
 
$DB = new DB();
?>