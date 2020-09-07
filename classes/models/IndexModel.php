<?php

class IndexModel extends DatabaseModel
{
  public function __construct()
  {
    $this->table = 'tabsclss_table';
    $this->table_columns = '(
      column1 INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
      column2 TEXT NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;';
    $this->run_database();
  }

  public function add_data($data)
  {
    $result = $this->run_query("INSERT INTO $this->table VALUES (NULL, :data)", ['data' => $data]);
    return $result;
  }

  public function get_data()
  {
    $result = $this->run_query("SELECT * FROM $this->table")->fetchAll();
    return $result;
  }
}
