<?php

class IndexController
{

  public static function get_view()
  {
    $table = new IndexModel();

    if (($_SERVER['REQUEST_METHOD'] == 'POST') && (isset($_POST['insert-data']) === TRUE))
    {
      $array = explode('.', $_POST['input-data']);
      foreach ($array as $values)
      {
        $table->add_data($array[rand(0, (count($array) - 1))]);
      }
    }

    if (empty($array) === FALSE)
    {
      $table->add_data($array[rand(0, (count($array) - 1))]);
      $data = (new IndexModel())->get_data();
      IndexView::display($data);
    }
    else {
      IndexView::display();
    }
  }
}
