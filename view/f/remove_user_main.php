<?php
include '../../include/database.php';

global $database;

$id = $_GET ['m_id'];

$q = "DELETE FROM " . TBL_MAIN_USERS . " WHERE m_id = '$id' ";
$result = $database->prepare ( $q );
$result->execute ();

header("Location: ../users.php?User Removed Successfully.!");

?>