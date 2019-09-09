<?php 
include '../include/session.php';
global $database;
if(isset($_POST['dept_name'])) {
  $q = "INSERT INTO " . TBL_DEPT . " (dept_name) VALUES (?)";
  $stmt = $database->prepare($q);
  $stmt->execute(array($_POST['dept_name']));
  if($stmt) {
    echo "<span class='label label-primary'>New Department Successfully Saved.</span>";
  } else {
    echo "<span class='label label-warning'>No Department Submitted.</span>";
  }
} else {
  echo "<span class='label label-danger'>Failed to Submit Form.</span>";
}
?>