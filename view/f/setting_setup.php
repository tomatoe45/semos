<?php 
include '../../include/session.php';

if(isset($_POST['save_dept']))
{
  global $database;
  $dname = $_POST['dept_name'];
  $database->exec("INSERT INTO " . TBL_DEPT . " (dept_name) VALUES ('$dname')");
  $session->message("<div class='alert alert-success'><h3>Well Done!</h3> New Department Successfully Added.</div>
    <embed src='../audio/Windows Print complete.wav' autostart='true' loop='true' width='2' height='0'></embed>");
  header("Location: ../settings.php");
} else
if(isset($_POST['save_c']))
{
  global $database;
  $cname = $_POST['cat_name'];
  $database->exec("INSERT INTO " . TBL_COMP . " (cat_complaint) VALUE ('$cname')");
  $session->message("<div class='alert alert-success'><h3>Well Done!</h3> New Complaint Category Successfully Added.</div>
    <embed src='../audio/Windows Print complete.wav' autostart='true' loop='true' width='2' height='0'></embed>");
  header("Location: ../settings.php");
} else 
if(isset($_POST['save_spec']))
{
  global $database;
  $cat_c = $_POST['cat_comp'];
  $s_n = $_POST['spec_n'];
  $database->exec("INSERT INTO " . TBL_SPEC . " (cat_comp_id, cat_specific) VALUES('$cat_c', '$s_n') ");
  $session->message("<div class='alert alert-success'><h3>Well Done!</h3> New Specific Category Successfully Added.</div>
    <embed src='../audio/Windows Print complete.wav' autostart='true' loop='true' width='2' height='0'></embed>");
  header("Location: " . $session->referrer);
} else 
if(isset($_POST['save_concern']))
{
  global $database;
  $c_n = $_POST['cat_name'];
  $s_n = $_POST['spec_name'];
  $con = $_POST['concern'];
  $database->exec("INSERT INTO " . TBL_CONC . "(cat_comp_id, cat_spec_id, cat_concern) VALUES('$c_n', '$s_n', '$con')");
  $session->message("<div class='alert alert-success'><h3>Well Done!</h3> New Concern Category Successfully Added.</div>
    <embed src='../audio/Windows Print complete.wav' autostart='true' loop='true' width='2' height='0'></embed>");
  header("Location: ../settings.php");
}
?>