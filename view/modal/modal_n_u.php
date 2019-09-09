<div class="modal fade inmodal" id="n_u" aria-hidden="true" tabindex="-1">
  <div class="modal-dialog" role="document">
    <form action="" method="post" class="form-horizontal">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
        <h4 class="modal-title"><img src="../images/semos.ico" alt="" class="img modal_logo" /> USER REGISTRATION FORM</h4>
      </div>
      <div class="modal-body">
        <div class="form-body">
          
          <div class="form-group">
            <input type="text" class="form-control" name="firstname"  placeholder="Enter Firstname" required="required">
          </div>

          <div class="form-group">
            <input type="text" class="form-control" name="lastname"  placeholder="Enter Lastname" required="required">
          </div>
          
          <div class="form-group">
            <select name="dept_n" class="form-control" required="required">
              <option selected="selected" disabled="disabled">SELECT DEPARTMENT</option>
              <?php foreach ($depts as $dept): ?>
                <option value="<?= $dept['dept_id']; ?>"><?= $dept['dept_name']; ?></option>
              <?php endforeach ?>
            </select>
          </div>
          
          <div class="form-group">
            <input type="text" class="form-control" name="user" placeholder="Enter Username" required="required">
          </div>

          <div class="form-group">
            <input type="password" class="form-control" name="pass" placeholder="Enter Password" required="required">
          </div>

          <div class="form-group">
            <select name="ulevel" class="form-control" required="required">
              <option value="" disabled="disabled" selected="selected">SELECT USER LEVEL</option>
              <option value="1">MEMBER USER LEVEL</option>
              <option value="7">EXPERT USER LEVEL</option>
              <option value="8">TECH SUPPORT USER LEVEL</option>
              <option value="9">ADMINISTRATOR USER LEVEL</option>
            </select>
          </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="reg_" class="btn btn-success"><i class="fa fa-user"></i> Register</button>
      </div>
    </div><!-- /.modal-content -->
    </form>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php 
 global $database;
 if(isset($_POST['reg_'])) {
  $fname = $_POST['firstname'];
  $lname = $_POST['lastname'];
  $dept  = $_POST['dept_n'];
  $uname = $_POST['user'];
  $upass = $_POST['pass'];
  $ulvl  = $_POST['ulevel'];

  $database->exec("INSERT INTO " . TBL_USERS . " (username, password, dept_id, firstname, lastname, userlevel)
                                            VALUES('$uname', '$upass', '$dept', '$fname', '$lname', '$ulevel')");
  $session->message("<div class='alert alert-success'><h3>Well Done!</h3>User Successfully Registered.!</div><embed src='../audio/Windows Print complete.wav' autostart='true' loop='true' width='2' height='0'></embed>");
 }
?>