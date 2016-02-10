<?php

$pageTitle = "Mass And Weight";
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
    $to_value = convert_mass($from_value, $from_unit, $to_unit);
}

$mass_options = array(
    "ounces",
    "pounds",
    "stones",
    "long tons",
    "short tons",
    "milligrams",
    "grams",
    "kilograms",
    "metric tonnes",
);

?>

      <div class="page-header">
        <h1>Convert mass and weight</h1>
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
                foreach ($mass_options as $unit) {
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
                  foreach ($mass_options as $unit) {
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
