<?php 
include '../include/session.php';
global $database;
if(isset($_POST['concern'])) {
  $q = "INSERT INTO " . TBL_CONC . "(cat_comp_id, cat_spec_id, cat_concern) VALUES(?, ?, ?) ";
  $stmt = $database->prepare($q);
  $stmt->execute(array($_POST['cat_name'], $_POST['spec_name'], $_POST['concern']));
  if($stmt) {
    echo "<span class='label label-primary'>New Concern Successfully Saved.</span>";
  } else {
    echo "<span class='label label-warning'>No Concern Submitted.</span>";
  }
} else {
  echo "<span class='label label-danger'>Failed to Submit Form.</span>";
}
?>