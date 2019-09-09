<?php 
include '../../include/session.php';

global $database;
$q = "SELECT * FROM " . TBL_COMPLAINT . " WHERE status = '0' " ;
$result = $database->prepare($q);
$result->execute();

$dbarray = $result->fetchAll(PDO::FETCH_ASSOC);

$num_rows = $result->rowCount();

echo $num_rows;

?>