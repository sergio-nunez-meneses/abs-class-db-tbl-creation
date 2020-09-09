<?php

class IndexView
{
  public static function init_view()
  {
    ob_start();
    ?>
    <div class="form-group">
      <button form="createForm" class="btn btn-lg w-100 bg-primary text-white" type="submit" name="create-database">Create database and table</button>
    </div>
    <?php
    $content = ob_get_clean();
    require('templates/template.php');
  }

  public static function data_view($data = [])
  {
    ob_start();
    if (empty($data) === TRUE)
    {
      ?>
      <div class="form-group">
        <input form="createForm" class="form-control text-center" type="text" name="input-data" placeholder="Enter a looooooooooong sequence of words, separated them with periods.">
      </div>
      <div class="form-group">
        <button form="createForm" class="btn btn-lg w-100 bg-primary text-white" type="submit" name="insert-data">Insert data</button>
      </div>
      <?php
    }
    else
    {
      ?>
      <h4 class="text-center"><em>Table data</em></h4>
      <table class="table table-bordered table-striped table-dark">
        <thead class="bg-primary">
          <tr>
            <th scope="col">1st column</th>
            <th scope="col">2nd column</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($data as $row)
          {
            ?>
            <tr>
              <td><?php echo $row['column1']; ?></td>
              <td><?php echo $row['column2']; ?></td>
            </tr>
            <?php
          }
          ?>
        </tbody>
      </table>
      <div class="form-group">
        <button form="createForm" class="btn btn-lg w-100 bg-danger text-white" type="submit" name="drop-database">Delete all</button>
      </div>
      <?php
    }
    $content = ob_get_clean();
    require('templates/template.php');
  }
}
