<?php
include '../../include/database.php';

global $database;

$id = $_GET['cat_spec_id'];

$q = "DELETE FROM " . TBL_SPEC . " WHERE cat_spec_id = '$id' ";
$result = $database->prepare ( $q );
$result->execute ();

header("Location: ../settings.php?Remove Successfully.!");

?>