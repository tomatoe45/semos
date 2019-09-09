<div class="modal inmodal fade" id="up_conc<?= $cc['cat_con_id'];?>">
  <div class="modal-dialog" role="document">
  <form action="" method="post" class="form-horizontal">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
        <h4 class="modal-title"><img src="../images/semos.ico" alt="" class="img modal_logo" /> UPDATE SPECIFIC CONCERN</h4>
      </div>
      <div class="modal-body">
        <div class="form-body">

          <div class="form-group">
            <label for="" class="control-label">COMPLAINT CATEGORY NAME :</label>
            <input type="text" class="form-control" value="<?= $cc['cat_complaint']; ?>" readonly="readonly">
            <input type="hidden" name="con_id" class="form-control" value="<?= $cc['cat_con_id']; ?>">
          </div>

          <div class="form-group">
            <label for="" class="control-label">SPECIFIC CATEGORY NAME :</label>
            <input type="text" class="form-control" value="<?= $cc['cat_specific'] ?>" readonly="readonly">
          </div>

          <div class="form-group">
            <label for="" class="control-label">SPECIFIC CONCERN NAME :</label>
            <input type="text" name="con_name" class="form-control" value="<?= $cc['cat_concern']; ?>">
          </div>
        
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="update_concern" class="btn btn-success"><i class="fa fa-save"></i> Save Changes</button>
      </div>
    </div><!-- /.modal-content -->
    </form>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php 
global $database;
if(isset($_POST['update_concern']))
{
  $id = $_POST['con_id'];
  $cname = $_POST['con_name'];

  $database->exec("UPDATE " . TBL_CONC . " SET cat_concern = '$cname' WHERE cat_con_id = '$id' ");
  $session->message("<div class='alert alert-success'><h3>Well Done!</h3>Concern Category Successfully Updated.!</div><embed src='../audio/Windows Print complete.wav' autostart='true' loop='true' width='2' height='0'></embed>");
  ?>
<script type="text/javascript">window.location = "settings.php?Concern Category Successfully Updated.!";</script>
  <?php } ?>