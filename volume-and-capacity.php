<?php

$pageTitle = "Volume And Capacity";
include('inc/header.php');

require_once("inc/convert_functions.php");

$from_value = "";
$from_unit = "";
$to_unit = "";
$to_value = "";

if (isset($_POST['submit'])) {
    $from_value = $_POST["from_value"];
    $from_unit = $_POST["from_unit"];
    $to_unit = $_POST["to_unit"];
    $to_value = convert_volume($from_value, $from_unit, $to_unit);
}

$volume_options = array(
    'cubic inches',
    'cubic feet',
    'Imperial gallons',
    'Imperial quarts',
    'Imperial pints',
    'Imperial cups',
    'Imperial ounces',
    'Imperial tablespoons',
    'Imperial teaspoons',
    'US gallons',
    'US quarts',
    'US pints',
    'US cups',
    'US ounces',
    'US tablespoons',
    'US teaspoons',
    'cubic centimeters',
    'cubic meters',
    'liters',
    'milliliters',
);

?>

      <div class="page-header">
        <h1>Convert volume and capacity</h1>
      </div>

      <div class="col-sm-offset-1">
        <p class="text-danger"><?php if (is_string($to_value)) { echo $to_value; } ?></p>
      </div>

      <br>
      <form action="" method="post" class="form-horizontal" role="form">
        <div class="form-group">
          <label class="control-label col-sm-1" for="from_value">From:</label>
          <div class="col-sm-2">
            <input type="text" class="form-control" name="from_value" id="from_value" value="<?php echo $from_value; ?>" <?php if (empty($from_value)) { echo " autofocus"; } ?>>
          </div>
          <div class="col-sm-2">
            <select class="form-control" name="from_unit">
              <option value="">-select unit</option>
                <?php
                foreach ($volume_options as $unit) {
                    $opt = optionize($unit);
                    echo "<option value=\"{$opt}\"";
                    if (isset($from_unit) && $from_unit == $opt) { echo " selected"; }
                    echo ">{$unit}</option>";
                }
                ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-1" for="to_value">To:</label>
          <div class="col-sm-2">
            <p class="form-control-static"><?php if (is_numeric($to_value)) { echo float_to_string($to_value); } ?></p>
          </div>
          <div class="col-sm-2">
            <select class="form-control" name="to_unit">
              <option value="">-select unit</option>
                  <?php
                  foreach ($volume_options as $unit) {
                      $opt = optionize($unit);
                      echo "<option value=\"{$opt}\"";
                      if (isset($to_unit) && $to_unit == $opt) { echo " selected"; }
                      echo ">{$unit}</option>";
                  }
                  ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-1 col-sm-4">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
          </div>
        </div>
      </form>

      <br>
      <hr>
      <div class="col-sm-offset-1">
        <a href="index.php"><button type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-chevron-left"></span> Return to menu</button></a>
      </div>

<?php include('inc/footer.php'); ?>
