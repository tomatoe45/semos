<?php include 'components/header.php'; ?>
<!-- iCheck -->
<link href="../assets/iCheck/skins/flat/green.css" rel="stylesheet">
<!-- Datatables -->
<link
	href="../assets/datatables.net-bs/css/dataTables.bootstrap.min.css"
	rel="stylesheet">
<link
	href="../assets/datatables.net-buttons-bs/css/buttons.bootstrap.min.css"
	rel="stylesheet">
<link
	href="../assets/datatables.net-scroller-bs/css/scroller.bootstrap.min.css"
	rel="stylesheet">
<link rel="stylesheet" href="../build/datepicker/jquery-ui.css">
<body class="nav-md">
  <div class="container body">
		<div class="main_container">
			<div class="col-md-3 left_col menu_fixed">
				<div class="left_col scroll-view">
          <?php include 'components/nav_title.php'; ?>
          <div class="clearfix"></div>

					<!-- menu profile quick info -->
					<div class="profile">
             <?php include 'components/profile-quick.php'; ?>
            </div>
					<!-- /menu profile quick info -->

					<br />

					<!-- sidebar menu -->
					<div id="sidebar-menu"
						class="main_menu_side hidden-print main_menu">
        <?php include 'components/sidebar.php'; ?>
            </div>
					<!-- /sidebar menu -->

					<!-- /menu footer buttons -->
					<div class="sidebar-footer hidden-small">
             <?php include 'components/sidebar-footer.php'; ?>
            </div>
					<!-- /menu footer buttons -->
				</div>
			</div>

			<!-- top navigation -->
			<div class="top_nav">
          <?php include 'components/navbar.php'; ?>
        </div>
			<!-- /top navigation -->

			<!-- page content -->
			<div class="right_col" role="main">
				<div class="">

					<div class="page-title">
						<h2 class="title_left">User's Profile Information</h2>
					</div>

					<div class="x_panel">

						<div class="x_title">
							<h3><?= ucfirst($session->firstname); ?>'s Profile</h3>
              <?= $session->message; ?>
            </div>
						<div class="x_content">

							<div class="row">
								<div class="col-md-4">

									<div class="row">
										<div class="col-md-12" align="center">
											<img id="user_profile_pic"
												src="profile/<?= $session->photo ? $session->photo : '../../images/user.png'; ?>"
												alt="Profile Picture" class="img thumbnail">
										</div>
									</div>
									<br> <br>
									<div class="row">
										<div class="col-md-12">

											<div class="form-group">
												<label class="control-label">Name:</label> <span><?= ucfirst($session->firstname) . ' ' . ucfirst($session->lastname); ?></span>
											</div>

											<div class="form-group">
												<label class="control-label">Department:</label> <span><?= ucwords($session->dept); ?></span>
											</div>

											<div class="form-group">
												<label class="control-label">Email Address:</label> <span><?= $session->email;?></span>
											</div>

											<div class="form-group">
												<label class="control-label">Birthday:</label> <span><?= $session->bday != '' ? date('M. d Y', strtotime($session->bday)) : '&hellip;'; ?></span>
											</div>

											<div class="form-group">
												<label class="control-label">Gender:</label> <span><?= $session->gender == 1 ? 'Male' : ($session->gender == 0 ? 'Female' : '&hellip;'); ?></span>
											</div>

											<div class="form-group">
												<label class="control-label">Contact No.:</label> <span><?= $session->contact ? $session->contact : '&hellip;'; ?></span>
											</div>

											<div class="form-group">
												<label class="control-label">Address:</label> <span><?= $session->address  ? ucwords($session->address) : '&hellip;'; ?></span>
											</div>

										</div>
									</div>

								</div>
								<div class="col-md-8">
									<div role="tabpanel" data-example-id="togglable-tabs">
										<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
											<li role="presentation" class="active"><a href="#tab_1"
												role="tab" id="profile-tab" data-toggle="tab"
												aria-expanded="false">PERSONAL INFO</a></li>
											<li role="presentation"><a href="#tab_2" role="tab"
												id="profile-tab" data-toggle="tab" aria-expanded="false">CHANGE
													AVATAR</a></li>
											<li role="presentation"><a href="#tab_3" role="tab"
												id="profile-tab" data-toggle="tab" aria-expanded="false">CHANGE
													PASSWORD</a></li>
										</ul>
										<div id="myTabContent" class="tab-content">
											<div id="tab_1" role="tabpanel"
												class="tab-pane fade in active"
												aria-labelledby="profile-tab">
												<div class="x_content">
													<form id="demo-form2" action="f/update_profile.php"
														method="post" data-parsley-validate
														class="form-horizontal">
														<div class="form-body">

															<div class="form-group">
																<label class="control-label col-md-3 col-sm-3 col-xs-12"
																	for="first-name">First Name :</label>
																<div class="col-md-6 col-sm-6 col-xs-12">
																	<input type="text" name="first-name"
																		required="required"
																		value="<?= ucfirst($session->firstname); ?>"
																		class="form-control col-md-7 col-xs-12">
																</div>
															</div>

															<div class="form-group">
																<label class="control-label col-md-3 col-sm-3 col-xs-12"
																	for="last-name">Last Name :</label>
																<div class="col-md-6 col-sm-6 col-xs-12">
																	<input type="text" id="last-name" name="last-name"
																		required="required"
																		value="<?= ucfirst($session->lastname); ?>"
																		class="form-control col-md-7 col-xs-12">
																</div>
															</div>

															<div class="form-group">
																<label for=""
																	class="control-label col-md-3 col-sm-3 col-xs-12">Email
																	:</label>
																<div class="col-md-6 col-sm-6 col-xs-12">
																	<input type="text" name="email"
																		class="form-control col-md-7 col-xs-12"
																		required="required" value="<?= $session->email; ?>"
																		placeholder="Email Address">
																</div>
															</div>

															<div class="form-group">
																<label class="control-label col-md-3 col-sm-3 col-xs-12">Gender
																	:</label>
																<div class="col-md-6 col-sm-6 col-xs-12">
																	<select name="gend" class="form-control"
																		required="required">
																		<option value="<?= $session->gender; ?>"
																			selected="selected"><?= $session->gender == 1 ? 'Male' : 'Female'; ?></option>
																		<option value="" disabled="disabled">Select Gender</option>
																		<option value="1">Male</option>
																		<option value="0">Female</option>
																	</select>
																</div>
															</div>

															<div class="form-group">
																<label class="control-label col-md-3 col-sm-3 col-xs-12">Date
																	Of Birth : </label>
																<div class="col-md-6 col-sm-6 col-xs-12">
																	<input name="dob"class="date-picker form-control col-md-7 col-xs-12"
																		id="datepicker"
																		value="<?php if($session->bday == '0000-00-00') {echo "";} else {echo $session->bday;}; ?>"
																		type="text" placeholder="Birthday">
																</div>
															</div>

															<div class="form-group">
																<label for="dept"
																	class="control-label col-md-3 col-sm-3 col-xs-12">Department
																	: </label>
																<div class="col-md-6 col-sm-6 col-xs-12">
																	<select name="dept" class="form-control" required="required">
																		<option value="<?= $session->dept; ?>" selected="selected">
                                                                            <?= $session->dept ? $session->dept : 'Please Select Department' ?></option>
																		<option value="" disabled="disabled">SELECT DEPARTMENT</option>
                                                                        <?php foreach($depts as $dept) : ?>
                                                                        <option value="<?= $dept['dept_id']; ?>"><?= $dept['dept_name']; ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
																</div>
															</div>

															<div class="form-group">
																<label class="control-label col-md-3 col-sm-3 col-xs-12">Contact
																	No. : </label>
																<div class="col-md-6 col-sm-6 col-xs-12">
																	<input name="contact"
																		data-inputmask="'mask' : '+63 (999) 999 9999'"
																		class="form-control col-md-7 col-xs-12" type="text"
																		placeholder="Ex. 123 456 7890"
																		value="<?= $session->contact; ?>">
																</div>
															</div>

															<div class="form-group">
																<label class="control-label col-md-3 col-sm-3 col-xs-12">Complete
																	Address :</label>
																<div class="col-md-6 col-sm-6 col-xs-12">
																	<textarea name="address"
																		class="form-control col-md-7 col-xs-12" rows="3"
																		placeholder="Complete Address"><?= $session->address; ?></textarea>
																</div>
															</div>

															<div class="ln_solid"></div>
															<div class="form-group">
																<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
																	<a
																		href="profile.php?settings=?account=<?=$session->firstname;?>"
																		class="btn btn-primary"><i class="fa fa-sign-out"></i>
																		Cancel</a>
																	<button type="submit" name="update_p"
																		class="btn btn-success">
																		<i class="fa fa-save"></i> Submit
																	</button>
																</div>
															</div>

														</div>
													</form>
												</div>
											</div>
											<div id="tab_2" role="tabpanel" class="tab-pane fade in"
												aria-labelledby="profile-tab">
												<div class="x_content">
													<div class="container">
														<form action="f/update_profile.php" method="POST"
															enctype="multipart/form-data">
															<div class="row center">
																<div class="col-md-4">
                                                                    <div class="thumbnails">
                                                                        <div class="thumbnail">
                                                                            <img id="uploadForm" class="preview img">
                                                                        </div>
                                                                    </div>
																</div>
																<div class="col-md-3">
																	<!-- <h3 class="page-header">Preview:</h3> -->
																	<div class="docs-preview clearfix">
																		<input type="file" name="file" id="file" class="btn btn-success" required="required" style="width: 120px;">
																		<hr>
																		<button type="submit" name="upload_a"
																			class="btn btn-success btn-responsive col-md-11 pull-right">
																			<i class="fa fa-upload"></i> Upload
																		</button>
																	</div>
																	<script type="text/javascript"
																		src="../build/js/jquery.min.js"></script>
																	<script type="text/javascript">
                                    function filePreview(input) {
                                        if (input.files && input.files[0]) {
                                            var reader = new FileReader();
                                            reader.onload = function (e) {
                                                $('#uploadForm + img').remove();
                                                $('#uploadForm').after('<img src="'+e.target.result+'" class=\'img prev_pic\'  />');
                                            }
                                            reader.readAsDataURL(input.files[0]);
                                        }
                                    }
                                    $("#file").change(function () {
                                        filePreview(this);
                                    });
                                    </script>
																</div>
															</div>
															<div class="row">
																<div class="col-md-12"></div>
															</div>
														</form>
													</div>
												</div>
											</div>
											<div id="tab_3" role="tabpanel" class="tab-pane fade in"
												aria-labelledby="profile-tab">
												<div class="x_content">
													<div class="container">
                           <?php
																											if (isset ( $_SESSION ['useredit'] )) {
																												unset ( $_SESSION ['useredit'] );
																												?>
                              <form id="demo-form2"
															data-parsley-validate method="POST"
															action="../include/process.php"
															class="form-horizontal form-label-left">

															<div class="form-group">
																<label class="control-label col-md-3 col-sm-3 col-xs-12"
																	for="curpass">Current Password :</label>
																<div class="col-md-6 col-sm-6 col-xs-12">
																	<div><?= $form->error('curpass'); ?></div>
																	<input type="password" id="currpass" name="curpass"
																		required="required"
																		class="form-control col-md-7 col-xs-12"
																		value="<?= $form->value('curpass'); ?>">
																</div>
															</div>

															<div class="form-group">
																<label class="control-label col-md-3 col-sm-3 col-xs-12"
																	for="newpass">New Password :</label>
																<div class="col-md-6 col-sm-6 col-xs-12">
																	<div><?= $form->error('newpass'); ?></div>
																	<input type="password" id="newpass" name="newpass"
																		required="required"
																		value="<?= $form->value('newpass'); ?>"
																		class="form-control col-md-7 col-xs-12">
																</div>
															</div>

															<div class="form-group">
																<label for="repass"
																	class="control-label col-md-3 col-sm-3 col-xs-12">Confirm
																	Password :</label>
																<div class="col-md-6 col-sm-6 col-xs-12">
																	<input type="hidden" class="form-control" value="1"
																		name="subedit"> <input id="repass"
																		class="form-control col-md-7 col-xs-12"
																		type="password" name="repass">
																</div>
															</div>

															<div class="ln_solid"></div>
															<div class="form-group">
																<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
																	<a
																		href="profile_settings.php?settings=?account=<?=$session->firstname;?>"
																		class="btn btn-primary"> <i class="fa fa-sign-out"></i>
																		Cancel
																	</a>
																	<button type="submit" class="btn btn-success">
																		<i class="fa fa-save"></i> Submit
																	</button>
																</div>
															</div>
														</form>
                                <?php
																											} else {
																												?>
                            <form id="demo-form2" data-parsley-validate
															method="POST" action="../include/process.php"
															class="form-horizontal form-label-left">

															<div class="form-group">
																<label class="control-label col-md-3 col-sm-3 col-xs-12"
																	for="curpass">Current Password :</label>
																<div class="col-md-6 col-sm-6 col-xs-12">
																	<div><?= $form->error('curpass'); ?></div>
																	<input type="password" id="currpass" name="curpass"
																		required="required"
																		class="form-control col-md-7 col-xs-12"
																		value="<?= $form->value('curpass'); ?>">
																</div>
															</div>

															<div class="form-group">
																<label class="control-label col-md-3 col-sm-3 col-xs-12"
																	for="newpass">New Password : </label>
																<div class="col-md-6 col-sm-6 col-xs-12">
																	<div><?= $form->error('newpass'); ?></div>
																	<input type="password" id="newpass" name="newpass"
																		required="required"
																		value="<?= $form->value('newpass'); ?>"
																		class="form-control col-md-7 col-xs-12">
																</div>
															</div>

															<div class="form-group">
																<label for="repass"
																	class="control-label col-md-3 col-sm-3 col-xs-12">Confirm
																	Password :</label>
																<div class="col-md-6 col-sm-6 col-xs-12">
																	<input type="hidden" class="form-control" value="1"
																		name="subedit"> <input id="repass"
																		class="form-control col-md-7 col-xs-12"
																		type="password" name="repass">
																</div>
															</div>

															<div class="ln_solid"></div>
															<div class="form-group">
																<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
																	<a
																		href="profile_settings.php?settings=?account=<?=$session->firstname;?>"
																		class="btn btn-primary"><i class="fa fa-sign-out"></i>
																		Cancel</a>
																	<button type="submit" class="btn btn-success">
																		<i class="fa fa-save"></i> Submit
																	</button>
																</div>
															</div>

														</form>
                            <?php } ?>
                          </div>
												</div>
											</div>
										</div>

									</div>
								</div>
							</div>

						</div>
					</div>

				</div>
			</div>
			<!-- /page content -->

			<!-- footer content -->
			<footer>
          <?php include 'components/footer.php'; ?>
        </footer>
			<!-- /footer content -->
		</div>
	</div>
	<!-- Input Mask -->
	<script type="text/javascript" src="../build/datepicker/jquery.js"></script>
	<script type="text/javascript" src="../build/datepicker/jquery-ui.js"></script>
	<script>
      $( "#datepicker" ).datepicker({
        inline: true
      });
    </script>

	<script>
      $(document).ready(function() {
        $(":input").inputmask();
      });
    </script>
	<!-- /inputMask -->

	<!-- jQuery -->
	<script src="../assets/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="../assets/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- FastClick -->
	<script src="../assets/fastclick/lib/fastclick.js"></script>
	<script
		src="../assets/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
	<!-- NProgress -->
	<script src="../assets/nprogress/nprogress.js"></script>
	<!-- Datatables -->
	<script src="../assets/datatables.net/js/jquery.dataTables.min.js"></script>
	<script
		src="../assets/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

	<!-- Custom Theme Scripts -->
	<script src="../build/js/custom.min.js"></script>
	<script type="text/javascript">
  $(document).ready(function() {
 setInterval(function() {
          $('#notify').load('f/get_complaint_count.php');
        }, 1000);
  });</script>

</body>
</html>