<div class="modal inmodal fade" id="u_t<?= $tk['task_id']; ?>" aria-hidden="true" tabindex="-1" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
  <form action="" method="post" class="form-horizontal">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
        <h4 class="modal-title"><img src="../images/semos.ico" alt="" class="img modal_logo" /> UPDATE TIME</h4>
      </div>
      <div class="modal-body">
        <div class="form-body">
          <div class="form-group">
            <label for="" class="control-label">EXECUTED BY</label>
            <span class="form-control"><?= ucfirst($tk['firstname']) . ' ' . ucfirst($tk['lastname']);  ?></span>
          </div>
          <div class="form-group">
            <label for="" class="control-label">TASK SUBJECT</label>
            <span class="form-control"><?= $tk['task_subject']; ?> </span>
          </div>
          <div class="form-group">
            <label for="" class="control-label">TIME UPDATE</label>      
            <input type="text" name="date" id="ec_date" class="form-control" placeholder="Date Executed "> 
            <input type="hidden" name="task_id" class="form-control" value="<?= $tk['task_id']; ?>">     
          </div>          
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="time_" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
      </div>
    </div><!-- /.modal-content -->
    </form>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php 
global $database;
if(isset($_POST['time_']))
{
  $d = $_POST['date'];
  $t_id = $_POST['task_id'];
  $database->exec("UPDATE " . TBL_TASK . " SET exec_date = '$d' WHERE task_id = '$t_id' ");
  $session->message("<di class='alert alert-success'><h3>Well Done.!</h3>Tasked Successfully Updated.!</div>
    <embed src='../audio/Windows Print complete.wav' autostart='true' loop='true' width='2' height='0'></embed>");
  ?>
  <script type="text/javascript">window.location = "maintenance.php?Task Updated Successfully!";</script>
  <?php } ?>