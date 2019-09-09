<?php 
include '../include/session.php';
global $database;
if(isset($_POST['spec_n'])) {
  $q = "INSERT INTO " . TBL_SPEC . " (cat_comp_id, cat_specific) VALUES(?, ?) ";
  $stmt = $database->prepare($q);
  $stmt->execute(array($_POST['cat_comp'], $_POST['spec_n']));
  if($stmt) {
    echo "<span class='label label-primary'>New Specific Category Successfully Saved.</span>";
  } else {
    echo "<span class='label label-warning'>No Specific Category Submitted.</span>";
  }
} else {
  echo "<span class='label label-danger'>Failed to Submit Form.</span>";
}
?>