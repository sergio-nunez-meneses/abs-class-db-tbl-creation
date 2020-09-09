<?php

class IndexController
{

  protected static $created_table;

  public static function get_view()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
      if (isset($_POST['create-database']) === TRUE)
      {
        self::$created_table = new IndexModel();
        IndexView::data_view();
      }
      elseif (isset($_POST['insert-data']) === TRUE)
      {
        self::$created_table = new IndexModel();
        $array = explode('.', $_POST['input-data']);
        for ($i = 0; $i < count($array); $i++)
        {
          self::$created_table->add_data($array[rand(0, (count($array) - 1))]);
        }
        $data = self::$created_table->get_data();
        IndexView::data_view($data);
      }
      elseif (isset($_POST['drop-database']) === TRUE)
      {
        (new IndexModel())->delete_all();
        IndexView::init_view();
      }
    }
    else
    {
      IndexView::init_view();
    }
  }
}
