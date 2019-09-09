<?php 
include '../../include/session.php';

global $database;

$fname   = $_POST['fname'];
$lname   = $_POST['lname'];
$gender  = $_POST['gender'];
$contact = $_POST['contact'];
$address = $_POST['address'];
// $photo   = $_POST['file'];

$attach = $_FILES ['file'] ['name'];
$size   = $_FILES ['file'] ['size'];
$type   = $_FILES ['file'] ['type'];
$temp   = $_FILES ['file'] ['tmp_name'];

move_uploaded_file ( $temp, "../profile/" . $attach );


$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q = "INSERT INTO " . TBL_MAIN_USERS . " (firstname, lastname, gender, contact, address, photo) 
                VALUES('$fname', '$lname', '$gender', '$contact', '$address', '$attach') ";
$database->prepare($q);
$database->exec($q);
$session->message("<div class='alert alert-success'><h3>Well Done!</h3> New user added Successfully.!</div>");

?>