<?php 
include '../../include/session.php';

global $database, $session;
if(isset($_POST['update_t']))
{
  $id = $_POST['task_id'];
  $stat = $_POST['stats'];

  $database->exec("UPDATE " . TBL_TASK . " SET status = '$stat' WHERE task_id = '$id' ");
  $session->message ( "<div class='alert alert-success'><p><h3>Well Done!</h3>Maintenance Task Successfully Updated</p></div>
    <embed src='../audio/Windows Print complete.wav' autostart='true' loop='true' width='2' height='0'></embed>" );
  header("Location: ../maintenance.php?Updated Successfully.!");
}
                                               

?>