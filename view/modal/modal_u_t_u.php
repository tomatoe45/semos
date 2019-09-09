<div class="modal inmodal fade" id="u_t_u<?= $tk['task_id']; ?>" role="dialog" data-keyboard="false" tabindex="-1" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <form action="f/update_task.php" method="post" class="form-horizontal">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
        <h4 class="modal-title"><img src="../images/semos.ico" alt="" class="img modal_logo" /> MAINTENANCE DAILY / TASK LOG</h4>
        <code>(Update Task / Log)</code>
      </div>

      <div class="modal-body">
        
          <div class="form-body">

            <div class="row">

              <div class="col-md-3 col-sm-12 col-xs-12 pull-right">
                <div class="form-group">
                  <input type="text" name="ticket" class="form-control" value="<?= $tk['ticket'] ?>" readonly="readonly">
                  <input type="hidden" name="task_id" class="form control" value="<?= $tk['task_id'];?>">
                </div>
              </div>

              <div class="col-md-3 col-sm-12 col-xs-12 pull-right">
                <div class="form-group">
                  <input type="text" name="task_date" class="form-control" value="<?= date('M. d Y h:i A', strtotime($tk['exec_date'])); ?>" readonly="readonly">
                </div>
              </div>

            </div>
            <!-- ./row -->

            <div class="row">

              <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="form-group">
                  <input type="text" class="form-control" value="<?= $tk['cat_complaint'];?>" readonly="readonly"></input>
                </div>
              </div>

              <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="form-group">
                  <input type="text" class="form-control" value="<?= $tk['cat_specific'];?>" readonly="readonly"></input>
                </div>
              </div>

              <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="form-group">
                  <input type="text" class="form-control" value="<?= $tk['cat_concern'];?>" readonly="readonly"></input>
                </div>
              </div>

            </div>


            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                  <input type="text" name="task_subject" class="form-control"
                    placeholder="Task Subject" required="required" value="<?= $tk['task_subject'];?>" readonly="readonly">
                </div>
              </div>
            </div>
            <!-- ./row -->
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                  <textarea name="task_desc" id="description" class="col-md-12 col-sm-12 col-xs-12"
                    rows="5" required="required" placeholder="Enter Description&hellip;" readonly="readonly"><?= $tk['task_desc']; ?></textarea>
                </div>
              </div>
            </div>
            <!-- ./row -->

            <br />

            <div class="row">
              <div class="col-md-3 col-sm-12 col-xs-12">
                <?php if($tk['status'] == 1) { ?>
                <label for="" class="control-label">STATUS :</label>
                <span>SOLVED</span>
                <?php } else { ?>
                <select name="stats" class="form-control">
                  <option value="<?= $tk['status'];?>" selected="selected"><?= $tk['status'] == 1 ? 'SOLVED' : 'PENDING'; ?></option>
                  <option value="" disabled="disabled">SELECT STATUS</option>
                  <option value="1">RESOLVED</option>
                  <option value="0">PENDING</option>
                </select>
              <?php } ?>
              </div>
              <div class="col-md-4 pull-right">
                <input type="text" class="form-control" value="<?= $tk['firstname'] . ' ' . $tk['lastname']; ?>" readonly="readonly"></input>
              </div>
              <div class="col-md-4 pull-right">
                <input type="text" class="form-control" value="<?= $tk['exec_name'] ? $tk['exec_name'] : '&hellip;'; ?>" readonly="readonly"></input>
                <code>Handled By - (Exclusive for Maintenance)</code>
              </div>
            </div>

          </div>

      </div>
      <?php if($tk['user_id'] == $session->id || $session->isAdmin()) { ?>
      <div class="modal-footer">
        <button type="submit" name="update_t" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
      </div>
      <?php } ?>
    </div><!-- /.modal-content -->
    </form>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- QUERY -->

<?php 

?>
