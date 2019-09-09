<?php 
include '../../include/session.php';
global $database;

if(isset($_POST['filter_dash']))
{
$start = $_POST['fromdate'];
$end = $_POST['todate'];
$tableContent = '';
$selectStmt = $database->prepare("SELECT * FROM " . TBL_COMPLAINT . " 
                                WHERE exec_date BETWEEN '" . date('Y-m-d', strtotime($start)) . "' AND '".date('Y-m-d', strtotime($end))."' "); // 2016-10-07 to 2016-10-10
$selectStmt->execute();
$tasked = $selectStmt->fetchAll(PDO::FETCH_ASSOC);
}
?>