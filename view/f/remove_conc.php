<?php
include '../../include/database.php';

global $database;

$id = $_GET['cat_con_id'];

$q = "DELETE FROM " . TBL_CONC . " WHERE cat_con_id = '$id' ";
$result = $database->prepare ( $q );
$result->execute ();

header("Location: ../settings.php?Remove Successfully.!");

?>