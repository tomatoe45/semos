<?php include 'components/header.php'; ?>
<!-- iCheck -->
<link href="../assets/iCheck/skins/flat/green.css" rel="stylesheet">
<!-- Datatables -->
<link	href="../assets/datatables.net-bs/css/dataTables.bootstrap.min.css"	rel="stylesheet">
<link href="../assets/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link	href="../assets/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
<body class="nav-md">
  <?php if($session->logged_in != $session->isAdmin()) { header('Location: dashboard.php?redirect=>home=>user='. $session->firstname);} ?>
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
						<div class="title_left">
							<h2>REGISTERED USERS LIST </h2>
						</div>
						<div class="title_right">
							<a href="#n_u" data-toggle="modal" class="btn btn-success btn-sm pull-right hide">
								NEW <i class="fa fa-plus"></i>
							</a>
              		<?php //include 'modal/modal_n_u.php'; ?>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel control_table">
								<div class="x_title">
									<h3>REGISTERED SYSTEM USERS</h3>
									<?= $session->message; ?>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
                  <div role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                      <li class="active" role="presentation">
                        <a href="#tab_1" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">MAINTENANCE USERS</a>
                      </li>
                      <li role="presentation">
                        <a href="#tab_2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">REGISTERED USERS</a>
                      </li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                      <div id="tab_1" role="tabpanel" aria-labelledby="profile-tab" class="tab-pane fade in active">
                        <div class="col-md-8">
                          <h2>MAINTENANCE REGISTERED USERS LISTS</h2>
                          <table id="datatable1" class="table table-hover table-stripped">
                            <thead>
                              <tr>
                                <th>ID</th>
                                <th>USER FULLNAME</th>
                                <th>CONTACT NUMBER</th>
                                <th>COMPLETE ADDRESS</th>
                                <th align='center'>GENDER</th>
                                <th>ACTION</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($mnt_users as $mu): ?>
                              <tr>
                                <td align='center'><span class='btn btn-danger btn-outline btn-rounded'><?= $mu['m_id']; ?></span></td>
                                <td align="center"><?= strtoupper($mu['firstname'] . ' ' . $mu['lastname']); ?></td>
                                <td align="center"><?= $mu['contact']; ?></td>
                                <td align="center"><p><?= ucwords($mu['address']); ?></p></td>
                                <td width="60" align="center"><?= $mu['gender'] == 1 ? "<i class='fa fa-male' data-toggle='tooltip' data-placement='top' title='Male'></i>" :
                                                                                       "<i class='fa-hover fa fa-female' data-toggle='tooltip' data-placement='top' title='Female'></i>"; ?></td>
                                <td width="100" align="center">
                                  <a href="#main_u_modal<?= $mu['m_id']; ?>" class="btn btn-primary btn-xs" data-toggle="modal"><i class="fa fa-edit"></i></a>
                                  <a href="f/remove_user_main.php?m_id=<?= $mu['m_id']; ?>" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Remove User"><i class="fa fa-trash"></i></a>
                                  <?php include 'modal/modal_main_user_updt.php'; ?>
                                </td>
                              </tr>
                            <?php endforeach ?>
                            </tbody>
                          </table>
                        </div>
                          
                        <div class="col-md-4">
                          <div class="x_panel">
                            <div class="x_title">
                              <h2 class="maintain_form">REGISTRATION FORM</h2>
                              <a class="btn btn-success btn-xs btn-outline pull-right collapse-link"><i class="fa fa-chevron-down"></i></a>
                              <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                              <form action="" method="post" class="form-horizontal" name="reg_form">
                                <div class="form-body">
                                  
                                  <div class="form-group">
                                    <input type="text" id="fname" name="fname" class="form-control" placeholder="Firstname" required="required">
                                  </div>

                                  <div class="form-group">
                                    <input type="text" id="lname" name="lname" class="form-control" placeholder="Lastname" required="required">
                                  </div>

                                  <div class="form-group">
                                    <select id="gender" name="gender" class="form-control" required="required">
                                      <option value="" disabled="disabled" selected="selected">SELECT GENDER</option>
                                      <option value="1">MALE</option>
                                      <option value="2">FEMALE</option>
                                    </select>
                                  </div>

                                  <div class="form-group">
                                    <input type="text" id="contact" name="contact" class="form-control" placeholder="Contact Number" data-inputmask="'mask' : '+64 (999) 999-9999'" required="required">
                                  </div>

                                  <div class="form-group">
                                    <input type="text" id="address" name="address" class="form-control" placeholder="Complete Address" required="required">
                                  </div>

                                  <div class="form-group hide">
                                    <input type="file" id="file" name="file" class="form-control">
                                  </div>
                                  
                                  <div class="form-group">
                                    <button type="reset" class="btn btn-success btn-outline pull-right"><i class="fa fa-refresh"></i> RESET</button>
                                    <button type="submit" name="reg_m_" class="btn btn-success btn-outline pull-right"><i class="fa fa-save"></i> REGISTER</button>    
                                  </div>
                                </div>
                              </form>
                              <?php 
                                global $database;
                                if(isset($_POST['reg_m_'])) {
                                  $fname   = $_POST['fname'];
                                  $lname   = $_POST['lname'];
                                  $gender  = $_POST['gender'];
                                  $contact = $_POST['contact'];
                                  $address = $_POST['address'];

                                  $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                  $q = "INSERT INTO " . TBL_MAIN_USERS . " (firstname, lastname, gender, contact, address, photo) 
                                                  VALUES('$fname', '$lname', '$gender', '$contact', '$address', '$attach') ";
                                  $database->prepare($q);
                                  $database->exec($q);
                                  ?>
                                  <script type="text/javascript">window.location = "users.php?Save Successfully";</script>
                                <?php
                                  $session->message("<div class='alert alert-success'><h3>Well Done!</h3> New user added Successfully.!</div>");
                                }
                              ?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div id="tab_2" role="tabpanel" aria-labelledby="profile-tab" class="tab-pane fade in">
                        <h2>REGISTERED USERS</h2>
                        <table id="datatable1" class="table table-hover table-striped">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>PHOTO</th>
                              <th>USER FULLNAME</th>
                              <th>USER USERNAME</th>
                              <th>USER DEPARTMENT</th>
                              <th>ACCESS LEVEL</th>
                              <th>ACTION</th>
                            </tr>
                          </thead>

                          <tbody>
                          <?php foreach($reg_users as $user) :?>
                            <tr>
                              <td align='center'><span class='btn btn-success btn-outline btn-rounded'><?= $user['user_id']; ?></span></td>
                              <td align="center" class="user-profile">
                                <img src="profile/<?= $user['photo'] ? $user['photo'] : '../../images/user.png' ; ?>"
                                  alt="" class="img" width="28" height="28" />
                              </td>
                              <td align="center"><?= strtoupper($user['firstname'] . ' ' . $user['lastname']); ?></td>
                              <td align="center"><?= strtoupper($user['username']); ?></td>
                              <td align="center"><?= strtoupper($user['dept_name']) ?></td>
                              <td align="center" width="90"><?= $user['userlevel'] == 9 ? 
                                    "<span class='btn btn-success btn-xs col-md-12'><i class='fa fa-check-square-o'></i> Administrator</span>"
                                    : ($user['userlevel'] == 8 ? "<span class='btn btn-success btn-xs col-md-12'><i class='fa fa-check-square-o'></i> Technical Support</span>"
                                    : ($user['userlevel'] == 7 ? "<span class='btn btn-success btn-xs col-md-12'><i class='fa fa-check-square-o'></i> Expert Level</span>"
                                    : "<span class='btn btn-success btn-xs col-md-12'><i class='fa fa-check-square-o'></i> Member</span>")); ?>
                              </td>
                              <td align="center">

                                <a href="#view_profile<?= $user['user_id']; ?>" class="btn btn-success btn-xs" data-toggle="modal"><i class="fa fa-eye"></i></a>
                                <?php if($session->isAdmin()) { ?>
                                <a href="#u_p<?= $user['user_id']; ?>" data-toggle="modal" class="btn btn-primary btn-xs">
                                  <i class="fa fa-edit"></i>
                                </a>
                                <?php if($user['userlevel'] != '9')  { ?>
                                <a href="f/remove_user.php?user_id=<?= $user['user_id']; ?>" class="btn btn-danger btn-xs">
                                  <i class="fa fa-trash"></i>
                                </a>
                                <?php } } ?>
                                </td>
                            </tr>
                            <?php 
                              include 'modal/modal_profile_view.php';
                              include 'modal/modal_u_p_u.php';
                            ?>
                            <?php endforeach;?>
                          </tbody>
                        </table>
                      </div>

                      
                    </div>
                  </div>
								</div>
							</div>
						</div>
					</div>
					<!-- /row -->
				</div>
			</div>
			<!-- /page content -->
			<!-- Modal Include -->

			<!-- /Modal Include -->
			<!-- footer content -->
			<footer>
          <?php include 'components/footer.php'; ?>
        </footer>
			<!-- /footer content -->
		</div>
	</div>
  <!-- jQuery -->
  <script type="text/javascript">jQuery.noConflict();</script>
  <script src="../assets/jquery/dist/jquery.min.js"></script>
  <script type="text/javascript" src="ajax/submit.js"></script>
  <!-- Bootstrap -->
  <script src="../assets/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- FastClick -->
  <script src="../assets/fastclick/lib/fastclick.js"></script>
  <!-- NProgress -->
  <script src="../assets/nprogress/nprogress.js"></script>
      <!-- Datarange Picker -->
  <script type="text/javascript" src="../build/daterange/moment.js"></script>
  <script type="text/javascript" src="../build/daterange/daterangepicker.js"></script>
  <!-- Datatables -->
  <script src="../assets/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
  <script src="../assets/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="../assets/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

  <!-- Custom Theme Scripts -->
  <script src="../build/js/custom.min.js"></script>
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
	<!-- Datatables -->
	<script>
      $(document).ready(function() {
        
      setInterval(function() {
        $('#notify').load('f/get_complaint_count.php');
      }, 1000);

      var handleDataTableButtons = function() {
        if ($("#datatable-buttons").length) {
          $("#datatable-buttons").DataTable({
            dom: "Bfrtip",
            responsive: true
          });
        }
      };


      $('#datatable1').dataTable({bFilter: false, bInfo: false, "bLengthChange": false, "lengthMenu": [15]});
      $('#datatable2').dataTable({bFilter: false, bInfo: false, "bLengthChange": false, "lengthMenu": [15]});
  
      $('#datatable-keytable').DataTable({
        keys: true
      });

      $('#datatable-responsive').DataTable();

      $('#datatable-scroller').DataTable({
        ajax: "js/datatables/json/scroller-demo.json",
        deferRender: true,
        scrollY: 380,
        scrollCollapse: true,
        scroller: true
      });

      TableManageButtons.init();
    });
  </script>
	<!-- /Datatables -->
</body>
</html>