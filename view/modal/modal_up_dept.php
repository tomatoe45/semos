<div class="modal inmodal fade" id="up_dept<?= $dept['dept_id']; ?>" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true" tabindex="-1">
  <div class="modal-dialog" role="document">
  <form action="" method="post" class="form-horinzontal">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
        <h4 class="modal-title"><img src="../images/semos.ico" alt="" class="img modal_logo" /> UPDATE DEPARTMENT</h4>
      </div>

      <div class="modal-body">
        <div class="form-body">
          
          <div class="form-group">
            <label for="" class="control-label">DEPARTMENT NAME :</label>
            <input type="text" name="d_name" class="form-control" placeholder="Department Name" value="<?= $dept['dept_name']; ?>" required="required">    
            <input type="hidden" name="d_id" class="form-control" value="<?= $dept['dept_id']; ?>">  
          </div>

        </div>
      </div>

      <div class="modal-footer">
        <button type="submit" name="update_dept" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
    </form>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php 
global $database;
if(isset($_POST['update_dept']))
{
  $id = $_POST['d_id'];
  $dname = $_POST['d_name'];

  $database->exec("UPDATE " . TBL_DEPT . " SET dept_name = '$dname' WHERE dept_id = '$id' ");
  $session->message("<div class='alert alert-success'><h3>Well Done!</h3> Department Name Successfully Updated.</div><embed src='../audio/Windows Print complete.wav' autostart='true' loop='true' width='2' height='0'></embed>");
  ?>
    <script type="text/javascript">window.location = "settings.php?Department Successfully Updated.!";</script>
  <?php } ?>