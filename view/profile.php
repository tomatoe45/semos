<?php include 'components/header.php'; ?>
<!-- iCheck -->
<link href="../assets/iCheck/skins/flat/green.css" rel="stylesheet">
<!-- Datatables -->
<link	href="../assets/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link	href="../assets/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link	href="../assets/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
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
						</div>
						<div class="x_content">
							
							<div class="row">
								<div class="col-md-4">

									<div class="row">
										<div class="col-md-12" align="center">
											<img id="user_profile_pic" src="profile/<?= $session->photo ? $session->photo : '../../images/user.png'; ?>"
											 alt="Profile Picture" class="img img-responsive thumbnail">
										</div>
									</div>

                  <br>
                  <br>

									<div class="row">
										<div class="col-md-12">
										<?php if(($session->isAdmin()) || ($session->isMaster()) ) {  ?>
											<div class="form-group">
												<label class="control-label">Name:</label>
												<span><?= ucfirst($session->firstname) . ' ' . ucfirst($session->lastname); ?></span>
											</div>

											<div class="form-group">
												<label class="control-label">Department:</label>
												<span><?= ucwords($session->dept); ?></span>
											</div>

											<div class="form-group">
												<label class="control-label">Email Address:</label>
												<span><?= $session->email;?></span>
											</div>

											<div class="form-group">
												<label class="control-label">Birthday:</label>
												<span><?= $session->bday != '' ? date('M. d Y', strtotime($session->bday)) : '&hellip;'; ?></span>
											</div>

											<div class="form-group">
												<label class="control-label">Gender:</label>
												<span><?= $session->gender == 1 ? 'Male' : ($session->gender == 0 ? 'Female' : '&hellip;'); ?></span>
											</div>

											<div class="form-group">
												<label class="control-label">Contact No.:</label>
												<span><?= $session->contact ? $session->contact : '&hellip;'; ?></span>
											</div>

											<div class="form-group">
												<label class="control-label">Address:</label>
												<span><?= $session->address  ? ucwords($session->address) : '&hellip;'; ?></span>
											</div>
											<?php } ?>
										</div>
									</div>

								</div>
								
								<div class="col-md-8">
								<?php if(($session->isAdmin()) || ($session->isMaster()) ) { ?>
									<div class="profile_title">
										<h2>User Activity Report</h2>
									</div>
									<div role="tabpanel" data-example-id="togglable-tabs">
										<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
											<li role="presentation" class="active">
												<a href="#tab_1" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">TASK WORKED ON</a>
											</li>
											<?php if( ($session->isAdmin()) || ($session->isMaster()) ) { ?>
											<li role="presentation">
												<a href="#tab_2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">COMPLAINT ASSISTED</a>
											</li>
											<li role="presentation">
												<a href="#tab_3" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">USER COMPLAINT</a>
											</li>
											<?php } ?>
										</ul>
										<div id="myTabContent" class="tab-content">
											<div id="tab_1" role="tabpanel" class="tab-pane fade in active" aria-labelledby="profile-tab">
												<table id="datatable9" class="table table-hover">
													<thead>
														<tr>
															<th>ID</th>
															<th>TASK SUBJECT</th>
															<th>DATE/TIME EXC</th>
															<th class="hide">CONSUME TIME</th>
															<th>STATUS</th>
														</tr>
													</thead>
													<tbody>
													<?php 
													 	foreach ($g_task as $gt) : ?>
														<tr>
															<td><?= $gt['task_id'] ?></td>
															<td><?= ucfirst($gt['task_subject']); ?></td>
															<td width="180"><?= date('M. d Y h:i A', strtotime($gt['exec_date'])); ?></td>
															<td width="40"><?= $gt['status'] == 1 ? "<span class='btn btn-success btn-xs col-md-12 col-sm-12 col-xs-12'><i class='fa fa-check-square-o'></i> SOLVED</span>"
																												 : "<span class='btn btn-danger btn-xs col-md-12 col-sm-12 col-xs-12'><i class='fa fa-times'></i> PENDING</span>" ?></td>
														</tr>
													<?php endforeach; ?>
													</tbody>
												</table>
											</div>
											<div id="tab_2" role="tabpanel" class="tab-pane fade in" aria-labelledby="profile-tab">
												<table id="datatable1" class="table table-hover">
													<thead>
														<tr>
															<th>ID</th>
															<th>SUBJECT</th>
															<th>DEPARTMENT</th>
															<th>DATE/TIME EXC</th>
															<th>STATUS</th>
														</tr>
													</thead>
													<tbody>
														<?php foreach ($u_a_comp as $uac): ?>
														<tr>
															<td><?= $uac['comp_id']; ?></td>
															<td><a href="#"><strong><?= ucfirst($uac['subject']); ?></strong></a></td>
															<td width="200"><?= $uac['dept_name']; ?></td>
															<td width="180"><?= $uac['res_date'] != '0000-00-00 00:00:00' ?  date('M. d Y h:i A', strtotime($uac['res_date'])) : '...'; ?></td>
															<td width="80"><?php if($uac['status'] == 5) {echo "<span class='btn btn-success btn-xs col-md-12 col-sm-12 col-xs-12'><i class='fa fa-check-square-o'></i> SOLVED</span>";} 
																	 else if($uac['status'] == 2) {echo "<span class='btn btn-danger btn-xs col-md-12 col-sm-12 col-xs-12'><i class='fa fa-times'></i> PENDING</span>";}
																	 else {echo "<span class='btn btn-info btn-xs col-md-12 col-sm-12 col-xs-12'><i class='fa fa-spinner fa-spin'></i> Processing&hellip;</span>";} ?></td>
														</tr>
														<?php endforeach ?>
													</tbody>
												</table>												
											</div>
											<div id="tab_3" role="tabpanel" class="tab-pane fade in" aria-labelledby="profile-tab" class='hide'>
												<div class="col-md-3">
													<a href="#mk_c_m" class="btn btn-success btn-xs" data-toggle="modal" data-placement="top" title="New Complaint">
													<i class="fa fa-plus"></i> New</a>
													<?php include 'modal/modal_mk_c.php'; ?>
												</div>
												<table id="datatable8" class="table table-hover">
													<thead>
														<tr>
															<th>SUBJECT</th>
															<th>COMPLAINT TYPE</th>
															<th>ASSISTED BY</th>
															<th>STATUS</th>
														</tr>
													</thead>
													<tbody>
														<?php foreach ($user_d_c as $uc): ?>
														<tr>
															<td><?= strtoupper($uc['subject']); ?></td>
															<td width="280"><?= strtoupper($uc['cat_complaint']); ?></td>
															<td width="200"><?= $uc['assisted'] ? 
																									"<button type='button' class='btn btn-success btn-xs col-md-12 col-sm-12 col-xs-12'><i class='fa fa-shield'></i> " . ucwords($uc['assisted']) . "</button>" : 
																									"<button type='button' class='btn btn-success btn-xs col-md-12 col-sm-12 col-xs-12'><i class='fa fa-spinner fa-spin'></i> REQUESTING&hellip;</button>"; ?></td>
															<td width="80"><?php if($uc['status'] == 5) {echo "<span class='btn btn-success btn-xs col-md-12 col-sm-12 col-xs-12'><i class='fa fa-check-square-o'></i> SOLVED</span>";} 
																	 else if($uc['status'] == 2) {echo "<span class='btn btn-danger btn-xs col-md-12 col-sm-12 col-xs-12'><i class='fa fa-times'></i> PENDING</span>";}
																	 else {echo "<span class='btn btn-info btn-xs col-md-12 col-sm-12 col-xs-12'><i class='fa fa-spinner fa-spin'></i> Processing&hellip;</span>";} ?></td>
														</tr>
														<?php endforeach ?>
													</tbody>
												</table>												
											</div>
										</div>
										
									</div>
									<?php } else { ?>
											<div class="form-group">
												<label class="control-label">Name:</label>
												<span><?= ucfirst($session->firstname) . ' ' . ucfirst($session->lastname); ?></span>
											</div>

											<div class="form-group">
												<label class="control-label">Department:</label>
												<span><?= ucwords($session->dept); ?></span>
											</div>

											<div class="form-group">
												<label class="control-label">Email Address:</label>
												<span><?= $session->email;?></span>
											</div>

											<div class="form-group">
												<label class="control-label">Birthday:</label>
												<span><?= $session->bday != '0000-00-00' ? date('M. d Y', strtotime($session->bday)) : '&hellip;'; ?></span>
											</div>

											<div class="form-group">
												<label class="control-label">Gender:</label>
												<span><?= $session->gender == 1 ? 'Male' : ($session->gender == 2 ? 'Male' : '&hellip;'); ?></span>
											</div>

											<div class="form-group">
												<label class="control-label">Contact No.:</label>
												<span><?= $session->contact ? $session->contact : '&hellip;'; ?></span>
											</div>

											<div class="form-group">
												<label class="control-label">Address:</label>
												<span><?= $session->address  ? ucwords($session->address) : '&hellip;'; ?></span>
											</div>
									<?php } ?>
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

	<!-- jQuery -->
	<script src="../assets/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="../assets/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- FastClick -->
	<script src="../assets/fastclick/lib/fastclick.js"></script>
	<!-- NProgress -->
	<script src="../assets/nprogress/nprogress.js"></script>
	<!-- Datatables -->
	<script src="../assets/datatables.net/js/jquery.dataTables.min.js"></script>
	<script
		src="../assets/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

	<!-- Custom Theme Scripts -->
	<script src="../build/js/custom.min.js"></script>

	<!-- Datatables -->
	<script>
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
              dom: "Bfrtip",
              responsive: true
            });
          }
        };
 setInterval(function() {
          $('#notify').load('f/get_complaint_count.php');
        }, 1000);

 $(".cat_name").change(function()
       {
        var id = $(this).val();
        var dataString = 'id=' + id;

        $.ajax({
          type: "POST",
          url: "f/get_specific.php",
          data: dataString,
          cache: false,
          success: function(html)
          {
            $(".spec_name").html(html);
          }
        });
       });

       $(".spec_name").change(function()
				{
					var id=$(this).val();
					var dataString = 'id='+ id;
				
					$.ajax
					({
						type: "POST",
						url: "f/get_concern.php",
						data: dataString,
						cache: false,
						success: function(html)
						{
							$(".cons_name").html(html);
						} 
					});
				});

        $('#datatable1').dataTable({bFilter: false, bInfo: false, "bLengthChange": false, "lengthMenu": [5]});
        $('#datatable2').dataTable({bFilter: false, bInfo: false, "bLengthChange": false, "lengthMenu": [5]});
        $('#datatable3').dataTable({bFilter: false, bInfo: false, "bLengthChange": false, "lengthMenu": [5]});
        $('#datatable4').dataTable({bFilter: false, bInfo: false, "bLengthChange": false, "lengthMenu": [5]});
        $('#datatable7').dataTable({bFilter: false, bInfo: false, "bLengthChange": false, "lengthMenu": [5]});
        $('#datatable8').dataTable({bFilter: false, bInfo: false, "bLengthChange": false, "lengthMenu": [5]});
        $('#datatable9').dataTable({bFilter: false, bInfo: false, "bLengthChange": false, "lengthMenu": [5]});
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