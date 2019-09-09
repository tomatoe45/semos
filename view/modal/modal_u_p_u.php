<div id="u_p<?= $user['user_id']; ?>" class="modal inmodal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title"><img src="../images/semos.ico" alt="" class="img modal_logo" /> USER PROFILE UPDATE</h3>
			</div>
			<div class="modal-body">
				<div class="form-body">
					
					<div class="row">
						<div class="col-md-8">
							
							<div class="form-group">
								<label class="control-label">Firstname:</label>
								<input type="text" class="form-control" name="firstname" value="<?= $user['firstname']; ?>" placeholder="Firstname"></input>
								<input type="hidden" class="form-control" name="user_id" value="<?= $user['user_id'];?>">
							</div>

							<div class="form-group">
								<label class="control-label">Lastname:</label>
								<input type="text" class="form-control" name="lastname" value="<?= $user['lastname']; ?>" placeholder="Lastname"></input>
							</div>

							<div class="form-group">
								<label for="" class="control-label">Email Address :</label>
								<input type="email" class="form-control" name="eadd" value="<?= $user['email'];?>" placeholder="Email Address">
							</div>

							<div class="form-group">
								<label class="control-label">Gender:</label>
								<select name="gender" class="form-control" required="required">
									<option value="<?= $user['gender'];?>" selected="selected"><?= $user['gender'] == 1 ? 'Male' : ($user['gender'] == 2 ? 'Female' : 'Please Select Gender'); ?></option>
									<option value="" disabled="disabled">SELECT GENDER</option>
									<option value="1">Male</option>
									<option value="2">Female</option>
								</select>
							</div>

						

							<div class="form-group">
								<label class="control-label">Birthday:</label>
								<input type="text" class="form-control date-picker" name="bday" value="<?= $user['bday']; ?>" id="datepicker"  placeholder="Birthday"></input>
							</div>

							<div class="form-group">
								<label class="control-label">Contact No.:</label>
								<input type="text" class="form-control" name="contact" value="<?= $user['contact']; ?>" placeholder="Ex. 123 456 7890" data-inputmask="'mask' : '+63 (999) 999 9999'"></input>
							</div>

							<div class="form-group">
								<label class="control-label">Address:</label>
								<input type="text" class="form-control" name="address" value="<?= $user['address']; ?>" placeholder="Complete Address"></input>
							</div>


						</div>

						<div class="col-md-4">
							<img name="pro_pic" src="profile/<?= $user['photo'] ?  $user['photo'] : '../../images/user.png'; ?>" class="img img-responsive" alt="User Profile">
							<br>
							<input type="file" name="file">
							<br>
							<br>

							<div class="form-group">
								<label class="control-label">Department:</label>
								<select name="department" class="form-control">
									<option value="<?= $user['dept_id']; ?>"><?= $user['dept_name']; ?></option>
									<?php foreach ($depts as $dept): ?>
										<option value="<?= $dept['dept_id']; ?>"><?= $dept['dept_name']; ?></option>
									<?php endforeach ?>
								</select>
							</div>

							<div class="form-group">
								<label class="control-label">User Level:</label>
								<select name="ulevel" class="form-control" required="required">
									<option value="<?= $user['userlevel']; ?>" selected="selected">
									<?= $user['userlevel'] == 9 ? 'Administrator' : ($user['userlevel'] == 8 ? 'Technical Support' : ($user['userlevel'] == 7 ? 'Expert Level' : 'Member Level')) ?>
									</option>
									<option value="" disabled="disabled">Please Specify Access Level</option>
									<option value="1">Member Level</option>
									<option value="7">Expert Level</option>
									<option value="8">Technical Support</option>
									<option value="9">Administrator Level</option>
								</select>
							</div>
						</div>	
					</div>

				</div>
			</div>
			<div class="modal-footer">
				<button  type="submit" name="update_" class="btn btn-success" ><i class="fa fa-save"></i> Update</button>
			</div>
		</div>
		</form>
	</div>	
</div>
<?php 
global $database;
if(isset($_POST['update_']) || !empty($_FILES['file']['name']))
{
	$uid = $_POST['user_id'];
	$fname = $_POST['firstname'];
	$lname = $_POST['lastname'];
	$em = $_POST['eadd'];
	$gen = $_POST['gender'];
	$dept = $_POST['department'];
	$bd = $_POST['bday'];
	$cont = $_POST['contact'];
	$addr = $_POST['address'];
	$ulvl = $_POST['ulevel'];
	//$pic = $_POST['prof_pic'];
	$attach = $_FILES ['file'] ['name'];
  $size   = $_FILES ['file'] ['size'];
  $type   = $_FILES ['file'] ['type'];
  $temp   = $_FILES ['file'] ['tmp_name'];

  move_uploaded_file ( $temp, "profile/" . $attach );
	
	$database->exec("UPDATE " . TBL_USERS . " SET 
		firstname = '$fname', 
		lastname  = '$lname', 
		email     = '$em', 
		photo     = '$attach', 
		gender    = '$gen', 
		dept_id   = '$dept', 
		bday      = '$bd', 
		contact   = '$cont', 
		address   = '$addr', 
		userlevel = '$ulvl' 
		WHERE 
		user_id   = '$uid' ");
	$session->message("<div class='alert alert-success'><h3>Well Done!</h3>User has been Successfully Updated.!</div><embed src='../audio/Windows Print complete.wav' autostart='true' loop='true' width='2' height='0'></embed>");
	?>
<script type="text/javascript"> window.location = "users.php?User has been updated Successfully!"; </script>
<?php } ?>