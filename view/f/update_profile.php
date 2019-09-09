<?php 
include '../../include/session.php';

global $database, $session;
if(isset($_POST['update_p']))
{
  $fname    = $_POST ['first-name'];
  $lname    = $_POST ['last-name'];
  $sx       = $_POST ['gend'];
  $bdate    = $_POST ['dob'];
  $em       = $_POST['email'];
  // $bdate = explode("/", $bdate);
  $dpt      = $_POST ['dept'];
  $num      = $_POST ['contact'];
  $addr     = $_POST ['address'];
  
  $database->exec("UPDATE " . TBL_USERS . " SET firstname = '$fname', lastname = '$lname', email = '$em', gender = '$sx', dept_id = '$dpt', bday = '$bdate', contact = '$num', address = '$addr' WHERE user_id = '$session->id' ");
  $session->message ( "<div class='alert alert-success'><p><h3>Well Done!</h3>Personal Information Successfully Updated</p></div>
    <embed src='../audio/Windows Print complete.wav' autostart='true' loop='true' width='2' height='0'></embed>" );
  header("Location: ../profile_settings.php");
}
else
if (isset ( $_POST ['upload_a'] ) && !empty($_FILES['file']['name']))
 {
  $attach = $_FILES ['file'] ['name'];
  $size   = $_FILES ['file'] ['size'];
  $type   = $_FILES ['file'] ['type'];
  $temp   = $_FILES ['file'] ['tmp_name'];

  move_uploaded_file ( $temp, "../profile/" . $attach );

  $database->exec ( "UPDATE " . TBL_USERS . " SET photo = '$attach' WHERE user_id = '" . $session->id . "' " );
  $session->message ( "<div class='alert alert-success col-md-12'><p><h3>Well Done!</h3>Avatar Uploaded successfully!</p></div>
    <embed src='../audio/Windows Print complete.wav' autostart='true' loop='true' width='2' height='0'></embed>" );
  header("Location: ../profile_settings.php?Avatar Successfully Updated.!");
  }                                                   

?>