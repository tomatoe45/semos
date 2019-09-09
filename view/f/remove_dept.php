<?php
include '../../include/database.php';

global $database;

$id = $_GET ['dept_id'];

$q = "DELETE FROM " . TBL_DEPT . " WHERE dept_id = '$id' ";
$result = $database->prepare ( $q );
$result->execute ();

header("Location: ../settings.php?Remove Successfully.!");

?>