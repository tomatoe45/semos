<div id="c_h_r<?= $lc['comp_id']; ?>" class="modal fade inmodal" role="dialog" aria-hidden="true" tabindex="-1" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">
  <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" class="form" enctype="multiplat/form-data">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title"><img src="../images/semos.ico" alt="" class="img modal_logo" /> COMPLAINT INFORMATION</h3>
      </div>

      <div class="modal-body">
        <div class="form-body">

          <div class="row">
            <div class="col-md-4 pull-left">
              <div class="form-group">
                <label for="" class="control-label">Complainant Name</label> 
                <input type="text" class="form-control" name="cname" value="<?= ucwords(strtolower($lc['firstname'] . ' ' . $lc['lastname'])); ?>"  readonly="readonly" />
                <input type="hidden" class="form-control" name="cid" value="<?= $lc['comp_id']; ?>">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="" class="control-label">Department :</label> 
                <input type="text" class="form-control" name="dept" value="<?= $lc['dept_name'] ?>" readonly="readonly" />
              </div>
            </div>
            <div class="col-md-4 pull-right">
              <div class="form-group">
                <label for="" class="control-label">Ticket No.:</label> 
                <input type="text" class="form-control" name="ticket" value="<?= $lc['ticket'] ?>" readonly="readonly" />
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="" class="control-label">Complaint Type:</label> <input
                  type="text" class="form-control" name="ctype" value="<?= $lc['cat_complaint'] ?>"
                  readonly="readonly" />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="" class="control-label">Spicific Complaint:</label>
                <input type="text" class="form-control" name="stype" value="<?= $lc['cat_specific']; ?>"
                  readonly="readonly" />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="" class="control-label">Concern Type:</label> <input
                  type="text" class="form-control" name="concern" value="<?= $lc['cat_concern']; ?>"
                  readonly="readonly" />
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="" class="control-label">Subject:</label> <input
                  type="text" class="form-control" name="subject" value="<?= $lc['subject']; ?>"
                  readonly="readonly" />
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="" class="control-label">Description:</label>
                <textarea name="descript" rows="5" class="form-control"
                  readonly="readonly"><?= $lc['description']; ?></textarea>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <?php if($lc['status'] == '5') { ?>
                <span class="form-control"><i class="fa fa-check-square-o"></i> RESOLVED</span>
                <?php } else if($lc['status'] == '2') { ?>
                <select name="stats" class="form-control col-md-4">
                  <option value="<?= $lc['status']; ?>" selected="selected"><?php if($lc['status'] == '2') { echo 'PENDING'; } else if($lc['status'] == '5') { echo 'RESOLVED';} ?></option>
                  <option value="" disabled="disabled">SELECT STATUS</option>
                  <option value="2">PENDING</option>
                  <option value="5">RESOLVED</option>
                </select>
                <?php } ?>
              </div>
            </div>
            <div class="col-md-4 pull-right">
               <span class="pull-right"><code>Assisted by:</code> <?= ucwords($lc['assisted']); ?></span>
            </div>
          </div>

        </div>
      </div>
      <?php if($lc['status'] == '5') { ?>
      <div class="modal-footer"></div>
      <?php }
        else if($lc['assisted'] == $session->firstname . ' ' . $session->lastname || $lc['cat_comp_id'] == '3')  { ?>
        <div class="modal-footer">
          <button type="submit" name="update_" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
        </div>
      <?php } else {  ?>
        <div class="modal-footer"></div>
      <?php } ?>
      </div>
    </form>
  </div>
</div>

<?php 
global $database;
if(isset($_POST['update_'])) {
  $id = $_POST['cid'];
  $stat = $_POST['stats'];

  $database->exec("UPDATE " . TBL_COMPLAINT . " SET status = '$stat', res_date = NOW() WHERE comp_id = '$id' ");
  $session->message("<div class='alert alert-success'><h3>Well Done</h3> Complaint Successfully Update.!</div>
                     <embed src='../audio/Windows Print complete.wav' autostart='true' loop='true' width='2' height='0'></embed>");
?>
<script type="text/javascript">window.location = "complaint_history.php?Successfully Updated";</script>
<?php } ?>