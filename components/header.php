<?php
include 'include/session.php';
include 'include/classes/department.php';
if ($session->logged_in) {
	header ( 'Location: view/dashboard.php' );
}

$depts = Department::getDepartment ();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="ISO-8859-1">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE-edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>SEMOS | Login Page</title>

<link href="assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/font-awesome/css/font-awesome.min.css"	rel="stylesheet">
<link rel="icon" href="images/semos.ico">
<link href="assets/iCheck/skins/flat/green.css" rel="stylesheet">
<link href="build/css/animate.min.css" rel="stylesheet">
<link href="build/css/custom.min.css" rel="stylesheet">
<link rel="stylesheet" href="build/css/user.custom.css" />
</head>