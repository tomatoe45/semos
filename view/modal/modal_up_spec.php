<div class="modal fade" id="up_spec<?= $st['cat_spec_id']; ?>">
  <div class="modal-dialog" role="document">
  <form action="" method="post" class="form-horizontal">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
        <h4 class="modal-title"><img src="../images/semos.ico" alt="" class="img modal_logo" /> UPDATE SPECIFIC CATEGORY</h4>
      </div>
      
      <div class="modal-body">
        <div class="form-body">
          <div class="form-group">
            <label for="" class="control-label">COMPLAINT CATEGORY NAME :</label>
            <input type="text" class="form-control" value="<?= $st['cat_complaint']; ?>" readonly="readonly">
            <input type="hidden" name="spec_id" class="form-control" value="<?= $st['cat_spec_id']; ?>" readonly="readonly">
          </div>
          <div class="form-group">
            <label for="" class="control-label">SPECIFIC CATEGORY NAME :</label>
            <input type="text" name="spec_name" class="form-control" value="<?= $st['cat_specific']; ?>" placeholder="SPECIFIC CATEGORY NAME" required="required">
          </div>    
        </div>
      </div>

      <div class="modal-footer">
        <button type="submit" name="up_spec" class="btn btn-success"><i class="fa fa-save"></i> Save Changes</button>
      </div>
    </div><!-- /.modal-content -->
    </form>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php 
global $database;
if(isset($_POST['up_spec']))
{
  $id = $_POST['spec_id'];
  $sp_name = $_POST['spec_name'];

  $database->exec("UPDATE " . TBL_SPEC . " SET cat_specific = '$sp_name' WHERE cat_spec_id = '$id' ");
  $session->message("<div class='alert alert-success'><h3>Well Done.!</h3> Specific Category Successfully Updated.</div><embed src='../audio/Windows Print complete.wav' autostart='true' loop='true' width='2' height='0'></embed>");
  ?>
<script type="text/javascript">window.location = "settings.php?Specific Category Successfully Updated.!";</script>
  <?php } ?>