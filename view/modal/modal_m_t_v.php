<div class="modal inmodal fade" id="m_t_v<?= $tk['task_id']; ?>" role="dialog"
 data-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
        <h4 class="modal-title"><img src="../images/semos.ico" alt="" class="img modal_logo" /> MAINTENANCE DAILY / TASK LOG</h4>
        <code>(View Task / Log)</code>
      </div>
      <div class="modal-body">
        
          <div class="form-body">

              <div class="row">

                <div class="col-md-3 col-sm-12 col-xs-12 pull-right">
                  <div class="form-group">
                    <input type="text" name="ticket" class="form-control" value="<?= $tk['ticket'] ?>" readonly="readonly">
                  </div>
                </div>

                <div class="col-md-3 col-sm-12 col-xs-12 pull-right">
                  <div class="form-group">
                    <input type="text" name="task_date" class="form-control"
                      value="<?= date('M. d Y h:i A', strtotime($tk['exec_date'])); ?>" readonly="readonly">
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
                  <input type="text" class="form-control" value="<?= $tk['status'] == 1 ? 'RESOLVED' : 'PENDING'; ?>" readonly="readonly"></input>
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
    
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- QUERY -->
