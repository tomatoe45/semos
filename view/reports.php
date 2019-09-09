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
<body class="nav-md">
<?php if( ($session->logged_in != $session->isAdmin()) && ($session->logged_in != $session->isMaster()) && ($session->logged_in != $session->isExpert()) )  { header('Location: dashboard.php?redirect=>home=>user='. $session->firstname);} ?>
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
							<h2>REPORT MANAGER</h2>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12 animate fadeInUp">
							<div class="x_panel control_table">
								<div class="x_title">
									<h3>COMPLAINT REPORTS</h3>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<table id="datatable1" class="table table-hover">
										<thead>
											<tr>
												<th width="150px">ACTIONS</th>
												<th width="450px">REPORT DESCRIPTION</th>
												<th>REMARKS</th>

											</tr>
										</thead>

										<tbody>
											<tr>
												<td align="center"><a
													href="r/rep_b_m_r.php?Biomedical Complaints Reports"
													class="btn btn-success btn-xs"><i class="fa fa-file-o"></i></a>
													<button type="button" class="btn btn-info btn-xs hide">
														<i class="fa fa-wrench"></i>
													</button></td>
												<td><a href="" data-toggle="tooltip" data-placement="right"
													title="Biomedical Complaint Lists"><strong>Biomedical
															Complaints</strong></a></td>
												<td align="center">&hellip;</td>
											</tr>
											<tr>
												<td align="center"><a
													href="r/rep_it_c_r.php?I.T. Complaints Report"
													class="btn btn-success btn-xs"><i class="fa fa-file-o"></i></a>
													<button type="button" class="btn btn-info btn-xs hide">
														<i class="fa fa-wrench"></i>
													</button></td>
												<td><a href="" data-toggle="tooltip" data-placement="right"
													title="I.T. Complaint Lists"><strong>I.T. Complaints</strong></a></td>
												<td align="center">&hellip;</td>
											</tr>
											<tr>
												<td align="center"><a
													href="r/rep_m_c_r.php?Maintenance Concerns Report"
													class="btn btn-success btn-xs"><i class="fa fa-file-o"></i></a>
													<button type="button" class="btn btn-info btn-xs hide">
														<i class="fa fa-wrench"></i>
													</button></td>
												<td><a href="" data-toggle="tooltip" data-placement="right"
													title="Maintenance Complaint Lists"><strong>Maintenance
															Concerns</strong></a></td>
												<td align="center">&hellip;</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!-- /row -->

					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12 animate fadeInUp">
							<div class="x_panel control_table">
								<div class="x_title">
									<h3>MAINTENANCE DAILY / TASKS REPORTS</h3>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<table id="datatable2" class="table table-hover">
										<thead>
											<tr>
												<th width="150">ACTION</th>
												<th width="450">REPORT DESCRIPTION</th>
												<th>REMARKS</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td align="center"><a href="r/rep_m_d_t.php"
													class='btn btn-success btn-xs'><i class="fa fa-file-o"></i></a>
													<span class='btn btn-primary btn-xs hide'></span></td>
												<td><a href="r/rep_m_d_t.php" data-toggle="tooltip"
													data-placement="right"
													title="Maintenance / Daily Task Report"> <strong>Maintenance
															Tasks Report</strong></a></td>
												<td>Maintenance / Daily Task Report</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12 animate fadeInUp">
							<div class="x_panel control_table">
								<div class="x_title">
									<h3>COMPLAINT REPORT AND STATUS</h3>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<table id="datatable3" class="table table-hover">
										<thead>
											<th width="150">ACTION</th>
											<th width="450">REPORT DESCRIPTION</th>
											<th>REMARKS</th>
										</thead>
										<tbody>
											<tr>
												<td align='center'><a href="r/rep_c_r_s.php"
													class='btn btn-success btn-xs'><i class="fa fa-file-o"></i></a>
													<span class='btn btn-primary btn-xs hide'></span></td>
												<td><a href="r/rep_c_r_s.php" data-toggle="tooltip"
													data-placement="right"
													title="Complaint Report and Statuses"> <strong>Complaint Report and Status</strong></a></td>
												<td>Complaint Report and Status Based on Complaint Type</td>
											</tr>
										</tbody>
									</table>
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

        $('#datatable1').dataTable({bFilter: false, bInfo: false, "bLengthChange": false, "lengthMenu": [5]});
        $('#datatable2').dataTable({bFilter: false, bInfo: false, "bLengthChange": false, "lengthMenu": [5]});
        $('#datatable3').dataTable({bFilter: false, bInfo: false, "bLengthChange": false, "lengthMenu": [5]});
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