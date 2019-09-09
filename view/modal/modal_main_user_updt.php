    <div class="modal inmodal fade" id="main_u_modal<?= $mu['m_id']; ?>" role="dialog" tabindex="-1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-md">

        <form action="" method="post" class="form-horizontal">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
            <h3 class="modal-title"><img src="../images/semos.ico" alt="" class="img modal_logo" /> UPDATE MAINTENANCE USER</h3>
          </div>

          <div class="modal-body">
            
            <div class="form-group">
              <input type="text" name="fname" class="form-control" placeholder="Firstname" value="<?= $mu['firstname']; ?>" required="required">
              <input type="hidden" name="m_id" class="form-control" placeholder="Firstname" value="<?= $mu['m_id']; ?>" required="required">
            </div>

            <div class="form-group">
              <input type="text" name="lname" class="form-control" placeholder="Lastname" value="<?= $mu['lastname']; ?>" required="required">
            </div>
            
            <div class="form-group">
              <select name="gender" class="form-control" required="required">
                <option value="<?= $mu['gender']; ?>" selected="selected"><?= $mu['gender'] == 1 ? "MALE": "FEMALE"; ?></option>
                <option value="" disabled="disabled">SELECT GENDER</option>
                <option value="1">MALE</option>
                <option value="2">FEMALE</option>
              </select>
            </div>

            <div class="form-group">
              <input type="text" name="contact" class="form-control" placeholder="Contact Number" value="<?= $mu['contact']; ?>" required="required">
            </div>

            <div class="form-group">
              <input type="text" name="address" class="form-control" placeholder="Complete Address" value="<?= $mu['address']; ?>" required="required">
            </div>

          </div>

          <div class="modal-footer">
            <button type="submit" name="update_main_u_" class="btn btn-success btn-outline"><i class="fa fa-save"></i> UPDATE</button>
          </div>
        </div><!-- /.modal-content -->
        </form>

      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <?php 
      global $database;
      if(isset($_POST['update_main_u_'])) {
      $mid = $_POST['m_id'];
      $fname = $_POST['fname'];
      $lname = $_POST['lname'];
      $gender = $_POST['gender'];
      $cont = $_POST['contact'];
      $addr = $_POST['address'];

      $database->exec("UPDATE " . TBL_MAIN_USERS . " SET firstname = '$fname', lastname = '$lname', gender = '$gender', contact = '$cont', address = '$addr' WHERE m_id = '$mid' ");
      $session->message("<div class='alert alert-success'><h3>Well Done.</h3>User information successfully updated.</div><embed src='../audio/Windows Print complete.wav' autostart='true' loop='true' width='2' height='0'></embed>");
      ?>
      <script type="text/javascript">window.location = "users.php?User Successfully Updated.";</script>
      <?php } ?>