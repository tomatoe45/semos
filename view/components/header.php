<?php
// error_reporting ( 0 );
include '../include/session.php';
include '../include/classes/users.php';
include '../include/classes/complaints.php';
include '../include/classes/department.php';
include '../include/classes/settings.php';
include '../include/classes/tasks.php';
include '../include/classes/dashboard.php';

if ((! $session->logged_in)) {
	header('Location: ../index.php' );
}

$depts     = Department::getDepartment ();
$reg_users = Users::displayUsers();
$mnt_users = Users::maintenanceUsers();
$t_users   = Users::getTechUsers();
$cat_s     = Settings::getCategory();
$comp_t    = Settings::getComplaintCategory();
$spec_t    = Settings::getComplaintSpecific();
$conc_t    = Settings::getComplaintConcern();
$g_comp    = Complaints::getComplaintList();
$a_comp    = Complaints::getComplaintAssisted();
$d_comp    = Complaints::getComplaintComplete();
$l_comp    = Complaints::getComplaintMonitored();
$u_a_comp  = Complaints::getUserAssistedComplaint();
$u_comp    = Complaints::getUsersComplaint();
$tasked    = Tasks::getAllTask();
$g_task    = Tasks::getUserTask();
$user_d_c  = Dashboard::getUserComplaint();


?>

<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="refresh" content="">
<title>SEMOS | Dashboard</title>
<link href="../assets/bootstrap/dist/css/bootstrap.min.css"
	rel="stylesheet">
<link href="../assets/font-awesome/css/font-awesome.min.css"
	rel="stylesheet">
<link
	href="../assets/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css"
	rel="stylesheet" />
<link rel="stylesheet" href="../assets/animate/animate.css" />
<link rel="stylesheet" href="../assets/animate/animate.min.css" />
<link href="../build/css/custom.min.css" rel="stylesheet">
<link rel="icon" href="../images/semos.ico">
<link rel="stylesheet" href="../build/css/user.custom.css" />
<link rel="stylesheet" href="../build/css/style.css" />
<link rel="stylesheet" href="../build/css/alt_complaint.css">
</head>