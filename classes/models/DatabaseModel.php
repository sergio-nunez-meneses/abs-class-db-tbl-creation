<?php
require('tools/sql.php');

abstract class DatabaseModel
{

  private $db = 'tabsclss';
  private $pdo;
  private $error;

  protected $table;
  protected $table_columns;

  protected function connexion()
  {
    $this->pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHAR, DB_USER, DB_PWD, PDO_OPTIONS);
    // echo 'Connected to database: ' . DB_NAME . '<br><hr>'; // just for debugging
    return TRUE;
  }

  protected function run_query($sql, $placeholders = [])
  {
    if ($this->connexion() === TRUE)
    {
      if (empty($placeholders))
      {
        return $this->pdo->query($sql);
      }
      else
      {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($placeholders);
        return $stmt;
      }
    }
  }

  protected function run_database()
  {
    $this->create_database();
    $this->create_table();
  }

  protected function create_database()
  {
    $this->pdo = new PDO('mysql:host=' . DB_HOST . ';charset=' . DB_CHAR, DB_USER, DB_PWD);

    if (empty($this->pdo) === FALSE)
    {
      $this->pdo->exec("CREATE DATABASE IF NOT EXISTS $this->db");
      $result = $this->pdo->exec("use $this->db");

      echo "Database: <em>$this->db</em> created! <br>";
      return TRUE;
    }
    else
    {
      echo 'Failed creating database. <br>';
      return FALSE;
    }
  }

  protected function create_table()
  {
    if ($this->connexion() === TRUE)
    {
      $result = $this->pdo->exec("CREATE TABLE IF NOT EXISTS $this->table $this->table_columns");

      echo "Table: <em>$this->table</em> and columns: <em>$this->table_columns</em> created! <br>";
      return TRUE;
    }
    else
    {
      echo 'Failed creating table and columns. <br>';
      return FALSE;
    }
  }
}
