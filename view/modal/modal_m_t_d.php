<?php 
 global $database;

$stmt = $database->query("SELECT task_id FROM " . TBL_TASK . " ORDER BY task_id DESC LIMIT 1");
$last_id = $stmt->fetch(PDO::FETCH_ASSOC);
$last_id = $last_id['task_id'];

$last_id = $last_id + 1;
if(isset($_POST['task_']))
{
  global $database;
  $tckt  = $_POST['ticket'];
  $ctype = $_POST['cat_name'];
  $stype = $_POST['spec_name'];
  $conc  = $_POST['cons_name'];
  $tsubj = $_POST['task_subject'];
  $tdesc = $_POST['task_desc'];
  $stats = $_POST['status'];
  $name = $_POST['u_name'];
  $ename = $_POST['maintain_name'];
  $database->exec("INSERT INTO " . TBL_TASK . " (ticket, cat_comp_id, cat_spec_id, cat_con_id, task_subject, task_desc, status, exec_date, user_id, exec_name) 
                                          VALUES('$tckt', '$ctype', '$stype', '$conc', '$tsubj', '$tdesc', '$stats', NOW(),'$name', '$ename' )");
  $session->message("<div class='alert alert-success'><h3>Well Done!</h3>Maintenance Task Successfully Save.!</div>
    <embed src='../audio/Windows Print complete.wav' autostart='true' loop='true' width='2' height='0'></embed>");
  echo "<script type='text/javascript'>window.location = 'maintenance.php?Task Successfully Saved';</script>"; 
  
 } ?>
<div class="modal inmodal fade" id="m_d_t" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <form action="" method="post" class="form-horizontal">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
        <h4 class="modal-title"><img src="../images/semos.ico" alt="" class="img modal_logo" /> MAINTENANCE DAILY / TASK LOG</h4>
        <code>(Manually Inputted Task)</code>
      </div>
      <div class="modal-body">
        
            <div class="form-body">

            <div class="row">

              <div class="col-md-3 col-sm-12 col-xs-12 pull-right">
                <div class="form-group">
                  <input type="text" name="ticket" class="form-control" value="MN-<?= str_pad($last_id, 4, "0000", STR_PAD_LEFT); ?>" readonly="readonly">
                </div>
              </div>

              <div class="col-md-3 col-sm-12 col-xs-12 pull-right">
                <div class="form-group">
                  <input type="text" name="task_date" class="form-control" value="Date : <?= date('M, d. Y'); ?>" readonly="readonly">
                </div>
              </div>

            </div>
            <!-- ./row -->

             <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="" class="control-label">Complaint Type:</label>
                  <select name="cat_name" class="form-control cat_name" required="required">
                      <option value="" disabled="disabled" selected="selected">SELECT COMPLAINT CATEGORY</option>
                      <?php foreach ($comp_t as $ct): ?>
                        <option value="<?= $ct['cat_comp_id'] ?>"><?= strtoupper($ct['cat_complaint']); ?></option>
                      <?php endforeach ?>
                    </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="" class="control-label">Specific Complaint:</label>
                  <select name="spec_name" class="form-control spec_name" required="required">
                    <option value="" selected="selected" disabled="disabled">SELECT SPECIFIC CATEGORY</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="" class="control-label" >Concern Type:</label>
                  <select name="cons_name" class="form-control cons_name" required="required">
                    <option value="" disabled="disabled" selected="selected">SELECT CONCERN CATEGORY</option>   
                               
                  </select>
                </div>
              </div>
            </div>


            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                  <input type="text" name="task_subject" class="form-control" placeholder="Task Subject" required="required">
                </div>
              </div>
            </div>
            <!-- ./row -->
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                  <textarea name="task_desc" id="description" class="col-md-12 col-sm-12 col-xs-12"
                    rows="5" required="required" placeholder="Enter Description&hellip;"></textarea>
                </div>
              </div>
            </div>
            <!-- ./row -->

            <br />

            <div class="row">
              <div class="col-md-3 col-sm-12 col-xs-12">
                <div class="btn-group" data-toggle="buttons">

                  <label class="btn btn-danger btn-xs" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                   <input type="radio" name="status" value="0" checked="checked"><i class="fa fa-times"></i> PENDING
                  </label>
                  <label class="btn btn-primary btn-xs" data-toggle-class="btn-success" data-toggle-passive-class="btn-default">
                   <input type="radio" name="status" value="1"><i class="fa fa-check-square-o"></i>  RESOLVED
                  </label>

                </div>
                <br>
                <code>(Pending) - by default</code>

              </div>
              <div class="col-md-4 pull-right">
                <select name="u_name" class="form-control" required="required">
                  <option value="<?= $session->id; ?>" selected="selected"><?= strtoupper($session->firstname . ' ' . $session->lastname); ?></option>
                  <option value="" disabled="disabled">EXECUTED BY (PLEASE SELECT)</option>
                  <?php foreach ($reg_users as $tu): ?>
                    <option value="<?= $tu['user_id']; ?>"> <?= strtoupper($tu['firstname'] . ' ' . $tu['lastname']); ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="col-md-5 pull-right">
                <select name="maintain_name" class="form-control" data-toggle="tooltip" data-placement="top" title="For Maintenance Users Only">
                  <option value="<?= strtoupper($session->firstname . ' ' . $session->lastname); ?>" selected="selected"><?= strtoupper($session->firstname . ' ' . $session->lastname); ?></option>
                  <option value="" disabled="disabled">PLEASE SELECT USER</option>
                  <?php foreach ($t_users as $ts): ?>
                    <option value="<?= ucwords($ts['firstname'] . ' ' . $ts['lastname']); ?>"><?= ucwords($ts['firstname'] . ' ' . $ts['lastname']); ?></option>
                  <?php endforeach ?>
                </select>
                <code>Handled By - (Exclusive for Maintenance)</code>
              </div>
            </div>

          </div>

      </div>
      <div class="modal-footer">
        <button type="submit" name="task_" class="btn btn-success"><i class="fa fa-save"></i> Save Task</button>
      </div>
    </div><!-- /.modal-content -->
    </form>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- QUERY -->
