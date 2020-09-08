<?php

class IndexView
{

  public static function display($data = [])
  {
    ?>
    <div class="container my-3 p-3 bg-info text-center text-white">
      <h3 class="py-3">Testing abstract classes, and database/table creation <em>on-the-fly</em></h3>
      <?php
      if (empty($data) === TRUE) {
        ?>
        <form class="" action="/" method="POST">
          <div class="form-group">
            <input class="form-control" type="text" name="input-data" placeholder="Enter a looooooooooong sequence of words, and separate them with periods.">
          </div>
          <div class="form-group">
            <button class="btn btn-lg w-100 bg-primary text-white" type="submit" name="insert-data">Insert</button>
          </div>
        </form>
        <?php
      } else {
        foreach ($data as $row) {
          ?>
          <p class="lead"><?php echo $row['column1']; ?></p>
          <p class="lead"><?php echo $row['column2']; ?></p>
          <?php
        }
      }
      ?>
    </div>
    <?php
  }
}
