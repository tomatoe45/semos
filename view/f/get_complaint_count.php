<?php 
include '../../include/session.php';

  $q = "SELECT * FROM " . TBL_COMPLAINT . " WHERE status = '0' ";
  $result = $database->prepare($q);
  $result->execute();

  $num_rows = $result->rowCount();

  echo $num_rows;

?>

