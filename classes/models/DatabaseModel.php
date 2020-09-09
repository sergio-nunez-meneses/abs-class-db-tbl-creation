<?php
require('tools/sql.php');

abstract class DatabaseModel
{

  private $pdo;
  private $error;

  protected $table;
  protected $table_columns;

  protected function connexion()
  {
    $this->pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHAR, DB_USER, DB_PWD, PDO_OPTIONS);

    if (empty($this->pdo) === FALSE)
    {
      // echo 'Connected to database: ' . DB_NAME . '<br>'; // just for debugging
      return TRUE;
    }
    else
    {
      echo "Failed connecting to database. <br>";
      return FALSE;
    }
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

  protected function create_database()
  {
    $this->pdo = new PDO('mysql:host=' . DB_HOST . ';charset=' . DB_CHAR, DB_USER, DB_PWD);

    if (empty($this->pdo) === FALSE)
    {
      $this->pdo->exec('CREATE DATABASE IF NOT EXISTS' . DB_NAME);
      $result = $this->pdo->exec('use' . DB_NAME);

      echo '
      <div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">
          <span>&times;</span>
        </button>
        <p class="text-center">Database: <em>' . DB_NAME . '</em> created!</p>
      </div>
      '; // just for debugging
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
      $this->pdo->exec("DROP TABLE IF EXISTS $this->table");
      $this->pdo->exec("CREATE TABLE IF NOT EXISTS $this->table $this->table_columns");

      echo '
      <div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">
          <span>&times;</span>
        </button>
        <p class="text-center">Table: <em>' . $this->table . '</em> and columns: <em>' . $this->table_columns . '</em> created!</p>
      </div>
      '; // just for debugging
      return TRUE;
    }
    else
    {
      echo 'Failed creating table and columns. <br>';
      return FALSE;
    }
  }

  protected function drop_database()
  {
    if ($this->connexion() === TRUE)
    {
      $this->pdo->exec('DROP DATABASE IF EXISTS' . DB_NAME);

      echo '
      <div class="alert alert-danger alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">
          <span>&times;</span>
        </button>
        <p class="text-center">Database: <em>' . DB_NAME . '</em> deleted.</p>
      </div>
      '; // just for debugging
      return TRUE;
    }
    else
    {
      echo 'Failed deleting database. <br>';
      return FALSE;
    }
  }

  protected function run_database()
  {
    $this->create_database();
    $this->create_table();
  }
}
