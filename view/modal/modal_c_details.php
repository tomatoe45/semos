<?php 
  $time_one = new DateTime($c['req_date']);
  $time_two = new DateTime($c['res_date']);
  $difference = $time_one->diff($time_two);
 ?>
<div class="modal inmodal fade" id="c_details<?= $c['comp_id'] ?>" aria-hidden="true" tabindex="-1" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg" role="document">
    <form action="" class="form-horizontal">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><img src="../images/semos.ico" alt="" class="img modal_logo" /> COMPLAINT DETAILS</h4>
        </div>
        <div class="modal-body">
          <div class="form-body">

            <div class="form-group">
               <label for="" class="control-label col-md-4 col-sm-5 col-xs-12">TICKET :</label>
               <label for="" class="control-label label_desc"><?= $c['ticket']; ?></label>
            </div>

            <div class="form-group">
               <label for="" class="control-label col-md-4 col-sm-5 col-xs-12">SUBJECT :</label>
               <label for="" class="control-label label_desc"><?= $c['subject']; ?></label>
            </div>

            <div class="form-group">
               <label for="" class="control-label col-md-4 col-sm-5 col-xs-12">COMPLAINT TYPE :</label>
               <label for="" class="control-label label_desc"><?= $c['cat_complaint']; ?></label>
            </div>

            <div class="form-group">
               <label for="" class="control-label col-md-4 col-sm-5 col-xs-12">SPECIFIC COMPLAINT :</label>
               <label for="" class="control-label label_desc"><?= $c['cat_specific']; ?></label>
            </div>

            <div class="form-group">
               <label for="" class="control-label col-md-4 col-sm-5 col-xs-12">CONCERN TYPE :</label>
               <label for="" class="control-label label_desc"><?= $c['cat_concern'] ?></label>
            </div>

            <div class="form-group">
               <label for="" class="control-label col-md-4 col-sm-5 col-xs-12">DESCRIPTION :</label>
               <label for="" class="control-label label_desc"><?= $c['description']; ?></label>
            </div>

            <div class="form-group">
               <label for="" class="control-label col-md-4 col-sm-5 col-xs-12">REMARKS :</label>
               <label for="" class="control-label label_desc"><?= $c['remarks'] ? $c['remarks'] : "<i class='fa fa-spinner fa-spin'></i> Processing&hellip;"; ?></label>
            </div>

            <div class="form-group">
               <label for="" class="control-label col-md-4 col-sm-5 col-xs-12">REQUESTED DATE :</label>
               <label for="" class="control-label label_desc"><?= date('M. d Y', strtotime($c['req_date'])) .' '.date('h:i A', strtotime($c['req_date'])); ?></label>
            </div>

            <div class="form-group">
               <label for="" class="control-label col-md-4 col-sm-5 col-xs-12">RESOLVED DATE :</label>
               <label for="" class="control-label label_desc"><?= $c['res_date'] == '0000-00-00 00:00:00' ?
                           "<i class='fa fa-spinner fa-spin'></i> Processing&hellip;" 
                           : date('M. d Y', strtotime($c['res_date'])) .' '.date('h:i A', strtotime($c['res_date'])); ?></label>
            </div>

            <div class="form-group">
               <label for="" class="control-label col-md-4 col-sm-5 col-xs-12">EXECUTION TIME :</label>
               <label for="" class="control-label label_desc"><?= $c['res_date'] == '0000-00-00 00:00:00' ? "<i class='fa fa-spinner fa-spin'></i> Processing&hellip;" : $difference->format('%h hr %i mn'); ?></label>
            </div>

            <div class="form-group">
               <label for="" class="control-label col-md-4 col-sm-5 col-xs-12">ASSISTED BY :</label>
               <label for="" class="control-label label_desc"> <?= $c['assisted'] ? 
                           "<i class='fa fa-user'></i> " . ucwords($c['assisted']) : 
                          "<i class='fa fa-spinner fa-spin'></i> REQUESTING&hellip;"; ?></label>
            </div>

            <div class="form-group">
               <label for="" class="control-label col-md-4 col-sm-5 col-xs-12">STATUS :</label>
               <label for="" class="control-label label_desc">
                 <?= $c['status'] == 0 ? '<button type="button" class="btn btn-default btn-xs"><i class="fa fa-spinner fa-spin"></i> PROCESSING&hellip;</button>'
                    : ($c['status'] == 1 ? '<button type="button" class="btn btn-success btn-xs"><i class="fa fa-comments-o"></i> ASSISTED</button>' 
                    : ($c['status'] == 2 ? '<button type="button" class="btn btn-warning btn-xs"><i class="fa fa-exclamation-triangle"></i> PENDING</button>'
                    : ($c['status'] == 5 ? '<button type="button" class="btn btn-success btn-xs"><i class="fa fa-check-square-o"></i> RESOLVED</button>' : ''))); ?>
               </label>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" data-dismiss="modal" class="btn btn-success btn-outline"><i class="fa fa-times"></i> Close</button>
        </div>
      </div><!-- /.modal-content -->
    </form>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->