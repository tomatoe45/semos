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
							<div class="clearfix"></div>
							<?= $session->message; ?>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel">
								<div class="x_title">
									<h2>
										<i class="fa fa-align-left"></i> SETTINGS PAGE
									</h2>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">

									<!-- start accordion -->
									<div class="accordion" id="accordion1" role="tablist"
										aria-multiselectable="true">
										<div class="panel">
											<h4 class="panel-title">
												<a class="panel-heading" role="tab" id="headingOne1"
													data-toggle="collapse" data-parent="#accordion1"
													href="#collapseOne1" aria-expanded="true"
													aria-controls="collapseOne"> COMPLAINT CATEGORY </a>
											</h4>
											<div id="collapseOne1" class="panel-collapse collapse"
												role="tabpanel" aria-labelledby="headingOne">
												<div class="panel-body">
													<div class="row">
														<div class="col-md-12">
															<table class="table table-hover">
																<thead>
																	<tr>
																		<th>ID</th>
																		<th>COMPLAINT CATEGORY NAME</th>
																		<th class="hide">ACTION</th>
																	</tr>
																</thead>
																<tbody>
	                              <?php foreach ($comp_t as $ct): ?>
	                                <tr>
																		<th scope="row"><?= $ct['cat_comp_id']; ?></th>
																		<td><?= strtoupper($ct['cat_complaint']); ?></td>
																		<td width="50" class="hide"><a href="#"
																			class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
																			<a href="#" class="btn btn-danger btn-xs"><i
																				class="fa fa-trash"></i></a></td>
																	</tr>
	                              <?php endforeach ?>
	                              </tbody>
															</table>
														</div>
														<div class="col-md-5 hide">
															<form action="f/setting_setup.php" method="post"
																class="form-horizontal">
																<div class="form-body">
																	<div class="form-group">
																		<label for="" class="control-label">Category Name :</label>
																		<input type="text" name="cat_name"
																			class="form-control"
																			placeholder="New Complaint Category"
																			required="required"> <br> <span><a href="#"
																			class="hide"><i class="fa fa-plus"></i> Add Row</a></span>
																	</div>
																	<div class="form-group">
																		<button type="submit" name="save_c"
																			class="btn btn-success pull-right">
																			<i class="fa fa-save"></i> Save
																		</button>
																	</div>
																</div>
															</form>
														</div>
													</div>

												</div>
											</div>
										</div>
										<div class="panel">
											<h4 class="panel-title">
												<a class="panel-heading collapsed" role="tab"	id="headingTwo1" data-toggle="collapse"	data-parent="#accordion1" href="#collapseTwo1"
													aria-expanded="false" aria-controls="collapseTwo">
													SPECIFIC COMPLAINT CATEGORY </a>
											</h4>
											<div id="collapseTwo1" class="panel-collapse collapse "	role="tabpanel" aria-labelledby="headingTwo">
												<div class="panel-body">
													<div class="row">
														<div class="col-md-8">
															<table id="spec_table" class="table table-hover spec_table" >
																<thead>
																	<tr class='hide'>
																		<th>ID</th>
																		<th>COMPLAINT CATEGORY NAME</th>
																		<th>SPECIFIC CATEGORY NAME</th>
																		<th width="50">ACTION</th>
																	</tr>
																</thead>
																<tbody>
	                              <?php foreach ($spec_t as $st): ?>
	                                <tr>
																		<th scope="row"><?= $st['cat_spec_id']; ?></th>
																		<th scope="row"><?= strtoupper($st['cat_complaint']); ?></th>
																		<td><?= strtoupper($st['cat_specific']); ?></td>
																		<td><a href="#up_spec<?= $st['cat_spec_id']; ?>"
																			data-toggle="modal" class="btn btn-success btn-xs"><i
																				class="fa fa-edit"></i></a> <a
																			href="f/remove_spec.php?cat_spec_id=<?= $st['cat_spec_id']; ?>"
																			class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
																		</td>
																	</tr>
                                  <?php include 'modal/modal_up_spec.php'; ?>
	                              <?php endforeach ?>
	                              </tbody>
															</table>
														</div>
														<div class="col-md-4">

															<form action="" method="post" class="form-horizontal" id="spec_form">
																<div class="form-body">
																	<div class="form-group">
																		<label for="" class="control-label">Specific Category
																			:</label> <select name="cat_comp"
																			class="form-control" required="required">
																			<option value="" disabled="disabled" selected="selected">PLEASE SELECT COMPLAINT CATEGORY</option>
	                            					<?php foreach ($comp_t as $ct): ?>
	                            						<option value="<?= $ct['cat_comp_id'] ?>"><?= strtoupper($ct['cat_complaint']); ?></option>
	                            					<?php endforeach ?>
	                            				</select>
																	</div>
																	<div class="form-group">
																		<label for="" class="control-label">Category Name :</label>
																		<input type="text" name="spec_n" id="spec_n" class="form-control"	placeholder="New Complaint Category" required="required">
																	</div>
																	<div class="form-group">
																		<button type="submit" name="save_spec" class="btn btn-success pull-right">
																			<i class="fa fa-save"></i> Save
																		</button>
																		<span class="label label-danger" id="error" style="display: none;"> Error</span>
																		<span class="label label-primary" id="success" style="display: none;" > Success</span>
																	</div>
																</div>
															</form>

														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="panel">
											<h4 class="panel-title">
												<a class="panel-heading collapsed" role="tab"
													id="headingThree1" data-toggle="collapse"
													data-parent="#accordion1" href="#collapseThree1"
													aria-expanded="false" aria-controls="collapseThree">
													CONCERN TYPE CATEGORY </a>
											</h4>
											<div id="collapseThree1" class="panel-collapse collapse "
												role="tabpanel" aria-labelledby="headingThree">
												<div class="panel-body">
													<div class="row">
														<div class="col-md-8">

															<table id="conc_table" class="table table-hover conc_table">
																<thead class='hide'>
																	<tr>
																		<th>ID</th>
																		<th>CATEGORY NAME</th>
																		<th>SPECIFIC NAME</th>
																		<th>CONCERN NAME</th>
																		<th width="50">ACTION</th>
																	</tr>
																</thead>
																<tbody>
	                              <?php foreach ($conc_t as $cc): ?>
	                                <tr>
																		<th scope="row"><?= $cc['cat_con_id']; ?></th>
																		<th scope="row"><?= strtoupper($cc['cat_complaint']); ?></th>
																		<th scope="row"><?= strtoupper($cc['cat_specific']); ?></th>
																		<td><?= strtoupper($cc['cat_concern']); ?></td>
																		<td><a href="#up_conc<?= $cc['cat_con_id']; ?>"
																			data-toggle="modal" class="btn btn-success btn-xs"><i
																				class="fa fa-edit"></i></a> <a
																			href="f/remove_conc.php?cat_con_id=<?= $cc['cat_con_id'] ?>"
																			class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
																		</td>
																	</tr>
                                  <?php include 'modal/modal_up_conc.php'; ?>
	                              <?php endforeach ?>
	                              </tbody>
															</table>

														</div>
														<div class="col-md-4">
															<form action="" method="post" class="form-horizontal" id="conc_form">
																<div class="form-body">

																	<div class="form-group">
																		<label for="" class="control-label">Complaint Category :</label> 
																		<select name="cat_name"	class="form-control cat_name" required="required">
																			<option value="" disabled="disabled" selected="selected">PLEASE SELECT COMPLAINT CATEGORY</option>
	                            					<?php foreach ($comp_t as $ct): ?>
	                            						<option value="<?= $ct['cat_comp_id'] ?>"><?= strtoupper($ct['cat_complaint']); ?></option>
	                            					<?php endforeach ?>
	                            			</select>
																	</div>

																	<div class="form-group">
																		<label for="" class="control-label">Specific Category</label>
																		<select name="spec_name" class="form-control spec_name" required="required">
																			<option value="" selected="selected" disabled="disabled">PLEASE SELECT SPECIFIC CATEGORY</option>
																		</select>
																	</div>

																	<div class="form-group">
																		<label for="" class="control-label">Concern Name :</label>
																		<input type="text" name="concern" id="concern" class="form-control" placeholder="New Complaint Category" required="required">
																	</div>

																	<div class="form-group">
																		<button type="submit" name="save_concern"	class="btn btn-success pull-right">
																			<i class="fa fa-save"></i> Save
																		</button>

																		<span class="label label-danger" id="error" style="display: none;"> Error</span>
																		<span class="label label-primary" id="success" style="display: none;" > Success</span>
																	</div>
																</div>
															</form>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="panel">
											<h4 class="panel-title">
												<a class="panel-heading collapsed" role="tab"	id="headingFour1" data-toggle="collapse" data-parent="#accordion1" 
												href="#collapseFour1"	aria-expanded="false" aria-controls="collapseThree">DEPARTMENT LISTS </a>
											</h4>
											<div id="collapseFour1" class="panel-collapse collapse"	role="tabpanel" aria-labelledby="headingThree">
												<div class="panel-body">
													<div class="row">
														<div class="col-md-8">
														
															<div class="content">
																<table id="datatables" class="table table-bordered">
																  <thead class='hide'>
																    <tr>
																      <th width="120">DEPT IDs</th>
																      <th>DEPARTMENT NAME</th>
																      <th width="90">ACTION</th>
																    </tr>
																  </thead>
																  <tbody>
																  <?php foreach ($depts as $dept): ?>
																   <tr>
																      <td><?= $dept['dept_id']; ?></td>
																      <td><?= strtoupper($dept['dept_name']); ?></td>
																      <td>
																      	<a href="#up_dept<?= $dept['dept_id']; ?>" data-toggle="modal" class="btn btn-success btn-xs">
																      	<i class="fa fa-edit"></i></a>
																      	<a  href="f/remove_dept.php?dept_id=<?= $dept['dept_id']; ?>" class="btn btn-danger btn-xs">
																      	<i class="fa fa-trash"></i></a>
																      </td>
																    </tr>   
																  <?php include 'modal/modal_up_dept.php'; ?> 
																  <?php endforeach ?>
																  </tbody>
																</table>

															</div>

														</div>

														<div class="col-md-4">
															<form method="post" class="horizontal-form" autocomplete="off" id="dept_form">
																<div class="form-body">
																	<div class="form-group">
																		<label for="" class="control-label">Department Name :</label>
																		<input type="text" id="dept_name" name="dept_name"	class="form-control" placeholder="Enter Department Name" required="required">
																	</div>
																	<div class="form-group">
																		<button type="submit" id="save_dept" name="save_dept" class="btn btn-success pull-right">
																			<i class="fa fa-save"></i> Save
																		</button>
																		<span class="label label-danger" id="error" style="display: none;"> Error</span>
																		<span class="label label-primary" id="success" style="display: none;" > Success</span>
																	</div>
																</div>
															</form>
														</div>
													</div>
												</div>
											</div>
										</div>

									</div>
									<!-- end of accordion -->
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
			<!-- /page content -->
			<!-- Modal Include -->
			<?php include 'modal/modal_settings_department.php'; ?>
			<!-- /Modal Include -->
			<!-- footer content -->
			<footer>
          <?php include 'components/footer.php'; ?>
        </footer>
			<!-- /footer content -->
		</div>
	</div>

	<!-- jQuery -->
	<script src="../assets/jquery/dist/jquery.min.js"></script>
	<script src="../build/js/jquery-1.12.4-jquery.min.js" type="text/javascript"></script>
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
	<script src="../build/js/submit_department.js"></script>

	<!-- Datatables -->
	<!-- <script type="text/javascript" src="../build/js/jquary-1.4.1.min.js"></script> -->
	<script>
      $(document).ready(function() {
				$('#datatables').dataTable( {
				  "scrollY": "300px",
				  "scrollCollapse": true,
				  "paging": false,
				  bFilter: false, 
				  bInfo: false,
				  "bLengthChange": false
				}),
				setInterval(function() {
					$('#datatables').load('settings.php #datatables');
				}, 500);

				$('#spec_table').dataTable( {
				  "scrollY": "300px",
				  "scrollCollapse": true,
				  "paging": false,
				  bFilter: false, 
				  bInfo: false,
				  "bLengthChange": false
				}),
				setInterval(function() {
					$('#spec_table').load('settings.php #spec_table');
				}, 500);

				$('#conc_table').dataTable( {
				  "scrollY": "300px",
				  "scrollCollapse": true,
				  "paging": false,
				  bFilter: false, 
				  bInfo: false,
				  "bLengthChange": false
				}),
				setInterval(function() {
					$('#conc_table').load('settings.php #conc_table');
				}, 500);

				 setInterval(function() {
          $('#notify').load('f/get_complaint_count.php');
        }, 1000);
        // setInterval(function() {
        //   $('.content').load('f/get_dept.php');
        // }, 1000);
        // setInterval(function() {
        // 	$('#datatable').load('settings.php #datatable');
        // }, 500);
        // function RefreshTable() {
        // 	$('.data_table').load('settings.php .data_table');
        // }
        // $('#refresh_table').on('click', RefreshTable);
        // $('#refresh_table').on('click', function() {
        // 	$('#datatable1').load('settings.php #datatable1');
        // });

        

    	 $(".cat_name").change(function()
    	 {
    	 	var id = $(this).val();
    	 	var dataString = 'id=' + id;

    	 	$.ajax({
    	 		type: "POST",
    	 		url: "f/get_spec.php",
    	 		data: dataString,
    	 		cache: false,
    	 		success: function(html)
    	 		{
    	 			$(".spec_name").html(html);
    	 		}
    	 	});
    	 });

        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
              dom: "Bfrtip",
              responsive: true
            });
          }
        };


        // $('#datatable1').dataTable({bFilter: false, bInfo: false, "bLengthChange": false, "lengthMenu": [5]});
        $('#datatable2').dataTable({
        	bFilter: false, 
        	bInfo: false, 
        	"bLengthChange": false, 
        	"lengthMenu": [5]
        });
        $('#datatable3').dataTable({bFilter: false, bInfo: false, "bLengthChange": false, "lengthMenu": [5]});
        $('#datatable4').dataTable({bFilter: false, bInfo: false, "bLengthChange": false, "lengthMenu": [5]});
        $('#datatable5').dataTable({bFilter: false, bInfo: false, "bLengthChange": false, "lengthMenu": [4]});
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