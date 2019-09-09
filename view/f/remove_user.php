<?php
include '../../include/database.php';

global $database;

$id = $_GET ['user_id'];

$q = "DELETE FROM " . TBL_USERS . " WHERE user_id = '$id' ";
$result = $database->prepare ( $q );
$result->execute ();

header("Location: ../users.php?User Removed Successfully.!");

?>