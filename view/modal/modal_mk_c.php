<?php 
global $database, $session;

$stmt = $database->query("SELECT comp_id FROM " . TBL_COMPLAINT . " ORDER BY comp_id DESC LIMIT 1");
$last_id = $stmt->fetch(PDO::FETCH_ASSOC);
$last_id = $last_id['comp_id'] + 1;


// $last_id = $last_id + 1;

if(isset($_POST['submit'])) {
  $name   = $session->id;
  $dept   = $session->dept_id;
  $ticket = $_POST['ticket'];
  $com    = $_POST['cat_name'];
  $spec   = $_POST['spec_name'];
  $con    = $_POST['cons_name'];
  $subj   = $_POST['subject'];
  $desc   = $_POST['descript'];
  // $file   = $_POST['attach'];
  
  $attach = $_FILES['attach']['name'];
  $size   = $_FILES['attach']['size'];
  $type   = $_FILES['attach']['type'];
  $temp   = $_FILES['attach']['tmp_name'];
  
  move_uploaded_file($temp, 'attachment/' . $attach);
  $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $q = "INSERT INTO " . TBL_COMPLAINT . "(user_id, dept_id, ticket, cat_comp_id, cat_spec_id, cat_con_id, subject, description, file, status, req_date) 
           VALUES('$name', '$dept', '$ticket', '$com', '$spec', '$con', '$subj', '$desc', '$attach', 0, NOW())";
    
  $database->exec($q);
  $session->message("<div class='alert alert-success'><h3>Well Done!</h3>Complaint Submitted Successfully.</div>
                     <embed src='../audio/Windows Print complete.wav' autostart='true' loop='true' width='2' height='0'></embed>");
?> 
<?php if( $session->logged_in && $session->isMember() ) { ?>
<script type="text/javascript">window.location = "dashboard.php?Complaint Syccessfully Submitted.!";</script>
<?php } else if($session->logged_in && $session->isExpert()) { ?>
<script type="text/javascript">window.location = "complaint.php?Complaint Syccessfully Submitted.!";</script>
<?php } } ?>

<div id="mk_c_m" class="modal inmodal fade">
  <div class="modal-dialog modal-lg" role="document">
  <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span>
        </button>

        <h4 class="modal-title"><img src="../images/semos.ico" alt="" class="img modal_logo" /> COMPLAINT FORM</h4>
      </div>
      <div class="modal-body">

        <div class="form-body">

          <div class="row">
            <div class="col-md-4 col-sm-12 col-xs-12 pull-left">
              <div class="form-group">
                <label for="" class="control-label">Complainant Name</label> 
                <input type="text" class="form-control" name="cname" value="<?= $session->firstname . ' ' . $session->lastname; ?>" readonly="readonly" />
              </div>
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <label for="" class="control-label">Department :</label>
                <input type="text" class="form-control" name="department" value="<?= $session->dept; ?>" readonly="readonly" />
              </div>
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12 pull-right">
              <div class="form-group">
                <label for="" class="control-label">Ticket No.:</label>
                <input type="text" class="form-control" name="ticket" value="CN-<?= str_pad($last_id, 4, "0000", STR_PAD_LEFT); ?>" readonly="readonly" />
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 col-sm-12 col-xs-12">
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
            <div class="col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <label for="" class="control-label">Specific Complaint:</label>
                <select name="spec_name" class="form-control spec_name" required="required">
                  <option value="" selected="selected" disabled="disabled">SELECT SPECIFIC CATEGORY</option>
                </select>
              </div>
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12">
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
                <label for="" class="control-label">Subject:</label> 
                <input type="text" name="subject" class="form-control" name="subject" placeholder="Subject Complaint" required="required"/>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="form-group">
                <label for="" class="control-label">Description:</label>
                <textarea name="descript" rows="5" class="form-control" placeholder="Enter Description &hellip;" required="required"></textarea>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="form-group">
                <label for="" class="control-label">Attachment:</label>
                <input type="file" name="attach">
              </div>
            </div>
          </div>

        </div>

      </div>
      <div class="modal-footer">
        <button type="submit" name="submit" class="btn btn-success"><i class="fa fa-save"></i> Submit</button>
      </div>
    </div><!-- /.modal-content -->
    </form>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
