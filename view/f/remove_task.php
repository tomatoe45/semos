<?php
include '../../include/database.php';

global $database;

$id = $_GET ['task_id'];

$q = "DELETE FROM " . TBL_TASK . " WHERE task_id = '$id' ";
$result = $database->prepare ( $q );
$result->execute ();

header("Location: ../maintenance.php?Task Removed.!");

?>