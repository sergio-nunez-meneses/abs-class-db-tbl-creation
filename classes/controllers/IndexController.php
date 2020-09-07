<?php

class IndexController
{

  public static function get_view()
  {
    if (($_SERVER['REQUEST_METHOD'] == 'POST') && (isset($_POST['insert-data']) === TRUE))
    {
      $array = explode(' ', $_POST['input-data']);
      $table->add_data($array[rand(0, (count($array) - 1))]);
    }

    $table = new IndexModel();

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
