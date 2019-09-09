    <div class="modal fade inmodal" id="c_toggle<?= $c['comp_id']; ?>" data-backdrop="static" data-keyboard="false" aria-hidden="-1" tabindex="false">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"><img src="../images/semos.ico" alt="" class="img modal_logo" /> COMPLAINT STATUS ASSISTANCE</h4>
          </div>
          <div class="modal-body">
            <div class="form-body form-horizontal">
              <div class="form-group">
                <label for="" class="control-label">STATUS :</label>
                <span><?= $c['status'] == 0 ? 'PROCESSING&hellip;' : ($c['status'] == 1 ? 'ASSISTED&hellip;' : ($c['status'] == 2 ? 'PENDING&hellip;' : ($c['status'] == 5 ? 'RESOLVED' : ''))); ?></span>
              </div>
              <div class="form-group">
                <label for="" class="control-label">DESCRIPTION :</label>
                <span><?= ucfirst($c['description']); ?></span>
              </div>
              <div class="form-group">
                <label for="" class="control-label">REMARKS :</label>
                <span><?= $c['remarks'] != NULL ? ucfirst($c['remarks']) : 'Currently Processing. Please wait&hellip;'; ?></span>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal"> <i class="fa fa-close"></i> Close</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->