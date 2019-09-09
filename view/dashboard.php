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
<body class="nav-md" onload="setTimeout(ajaxcall, 1000)">
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
				<?php if( ($session->logged_in) && ($session->isAdmin()) || ($session->isExpert()) ) { ?>
					<div class="row top_tiles">
						<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="tile-stats">
								<div class="icon">
									<i class="fa fa-headphones"></i>
								</div>
								<div class="count"><?= $complaints->getSolveComplaint(); ?></div>
								<h3>
									<a href="#">RESOLVED COMPLAINTS</a>
								</h3>
								<p>OVERALL DEPARTMENT</p>
							</div>
						</div>
						<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="tile-stats">
								<div class="icon">
									<i class="fa fa-flag-o"></i>
								</div>
								<div class="count"><?= $complaints->getPendingComplaint();  ?></div>
								<h3>
									<a href="#">PENDING COMPLAINTS</a>
								</h3>
								<p>OVERALL DEPARTMENT</p>
							</div>
						</div>
						<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="tile-stats">
								<div class="icon">
									<i class="fa fa-sort-amount-desc"></i>
								</div>
								<div class="count"><?= $complaints->getTotalComplaint(); ?></div>
								<h3>
									<a href="complaint.php?Complaint Lists">TOTAL COMPLAINTS</a>
								</h3>
								<p>OVERALL DEPARTMENT</p>
							</div>
						</div>
						<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="tile-stats">
								<div class="icon">
									<i class="fa fa-users"></i>
								</div>
								<div class="count"><?= $users->getNumMembers(); ?></div>
								<h3>
									<a href="users.php?Complete Registered Users">REGISTERED USERS</a>
								</h3>
								<p>TOTAL REGISTERED USERS</p>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6 col-sm-12 col-xs-12 animate fadeInUp">
							<div class="x_panel control_table">
								<div class="x_title">
									<h2>RESOLVED COMPLAINT</h2>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<table id="datatable1" class="table table-hover">
										<thead>
											<tr>
												<th>DEPARTMENT NAME</th>
												<th width="60px">STATISTICS</th>
											</tr>
										</thead>

										<tbody>
										<?php foreach ($depts as $dept) : ?>
											<tr>
												<td><strong><?= strtoupper($dept['dept_name']); ?></strong></td>
												<td align="center">
													<?php
														$id = $dept ['dept_id'];
														$q = "SELECT * FROM " . TBL_COMPLAINT . " WHERE dept_id = '$id' AND status = '5' ";
														$result = $database->prepare ( $q );
														$result->execute ();
														$dbarray = $result->fetchAll ( PDO::FETCH_ASSOC );
														$num_rows = $result->rowCount ();
														echo $num_rows;
														?>
												</td>
											</tr>
										<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-12 col-xs-12 animate fadeInUp">
							<div class="x_panel control_table">
								<div class="x_title">
									<h2>PENDING COMPLAINT</h2>
									<div class="clearfix"></div>
								</div>

								<div class="x_content">
									<table id="datatable2"
										class="table table-hover table-responsive">
										<thead>
											<tr>
												<th>DEPARTMENT NAME</th>
												<th width="60px">STATISTICS</th>
											</tr>
										</thead>

										<tbody>
											<?php foreach ($depts as $dept) : ?>
											<tr>
												<td><strong><?= strtoupper($dept['dept_name']); ?></strong></td>
												<td align="center">
													<?php
														$id = $dept ['dept_id'];
														$q = "SELECT * FROM " . TBL_COMPLAINT . " WHERE dept_id = '$id' AND status BETWEEN '0' AND '2' ";
														$result = $database->prepare ( $q );
														$result->execute ();
														$dbarray = $result->fetchAll ( PDO::FETCH_ASSOC );
														$num_rows = $result->rowCount ();
														echo $num_rows;
														?>
												</td>
											</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>

					</div>
					<!-- /row -->
					<div class="row">
						<div class="col-md-6 col-sm-12 col-xs-12 animate fadeInUp">
							<div class="x_panel control_table">
								<div class="x_title">
									<h2>TOTAL COMPLAINTS</h2>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<table id="datatable3"
										class="table table-hover table-responsive">
										<thead>
											<tr>
												<th>DEPARTMENT NAME</th>
												<th width="60px">STATISTICS</th>
											</tr>
										</thead>

										<tbody>
											<?php foreach ($depts as $dept) : ?>
											<tr>
												<td><strong><?= strtoupper($dept['dept_name']); ?></strong></td>
												<td align="center">
													<?php
                                                    $id = $dept ['dept_id'];
                                                    $q = "SELECT * FROM " . TBL_COMPLAINT . " WHERE dept_id = '$id'";
                                                    $result = $database->prepare ( $q );
                                                    $result->execute ();
                                                    $dbarray = $result->fetchAll ( PDO::FETCH_ASSOC );
                                                    $num_rows = $result->rowCount ();
                                                    echo $num_rows;
                                                    ?>
												</td>
											</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-12 col-xs-12 animate fadeInUp">
							<div class="x_panel control_table">
								<div class="x_title">
									<h2>COMPLAINT STATISTICS</h2>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<table class="table table-hover table-responsive">
										<thead>
											<tr>
												<th>DEPARTMENT NAME</th>
												<th width="90">TOTAL</th>
												<th width="90">PENDING</th>
												<th width="90">RESOLVED</th>
											</tr>
										</thead>

										<tbody>
											<tr>
												<th>BIOMEDICAL COMPLAINTS</th>
												<th scope="row" style="text-align: center;"><?= $complaints->getComplaintTotalBiomed(); ?></th>
												<th scope="row" style="text-align: center;"><?= $complaints->getComplaintTotalBIOPENDING(); ?></th>
												<th scope="row" style="text-align: center;"><?= $complaints->getComplaintTotalBIOSOLVED(); ?></th>
											</tr>
											<tr>
												<th>I.T. CONCERNS</th>
												<th scope="row" style="text-align: center;"><?= $complaints->getComplaintTotalIT(); ?></th>
												<th scope="row" style="text-align: center;"><?= $complaints->getComplaintTotalITPENDING(); ?></th>
												<th scope="row" style="text-align: center;"><?= $complaints->getComplaintTotalITSOLVED(); ?></th>
											</tr>
											<tr>
												<th>MAINTENANCE CONCERNS</th>
												<th scope="row" style="text-align: center;"><?= $complaints->getComplaintTotalMT(); ?></th>
												<th scope="row" style="text-align: center;"><?= $complaints->getComplaintTotalMNPENDING(); ?></th>
												<th scope="row" style="text-align: center;"><?= $complaints->getComplaintTotalMNSOLVED(); ?></th>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>

					</div>
					<!-- /row -->
					<?php } elseif( ($session->logged_in)  && ($session->isMember())) { ?>
					<div class="page-title">
						<div class="title_left">
							<h2>COMPLAINT TRACKING SHEET</h2>
						</div>

					</div>

					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel control_table">
								<div class="x_title">
									<h2>COMPLAINT TABLE</h2>

									<a href="#mk_c_m" class="btn btn-success btn-xs pull-right"
										data-toggle="modal" data-placement="top" title="New Complaint">
										<i class="fa fa-plus"></i> New Complaint
									</a>

									<div class="clearfix"></div>
                                    <input type="text" class="form-control filter_search" name="filter" placeholder="Search..."/>
                                    <br />
                                    <?= $session->message; ?>
								</div>
								<div id="user_complaint" class="x_content"></div>
							</div>
						</div>
					</div>
				<?php } elseif( ($session->logged_in) && ($session->isMaster())) { ?>
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel control_table">
								<div class="x_title">
									<h2>COMPLAINT LISTS</h2>
									<div class="clearfix"></div>
                                    <?= $session->message; ?>
                                </div>
								<div class="x_content">
									<div class="x_contents"></div>
								</div>
							</div>
						</div>

					</div>
				<?php } ?>
				</div>
			</div>
			<!-- /page content -->

			<!-- modal -->
				<?php include 'modal/modal_mk_c.php'; ?>
							<!-- /modal -->
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
	<script src="../assets/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

	<!-- Datarange Picker -->
	<script type="text/javascript" src="../build/daterange/moment.js"></script>
	<script type="text/javascript"
		src="../build/daterange/daterangepicker.js"></script>

	<!-- Custom Theme Scripts -->
	<script src="../build/js/custom.min.js"></script>
	<!-- Datatables -->

	<script>
      $(document).ready(function() {

          setInterval(function() {
              $('#notify').load('f/get_complaint_count.php');
          }, 1000);

          var time = setInterval(function() {
              $('#user_complaint').load('f/get_user_complaint.php');
          }, 1000);

          $('.filter_search').keyup(function() {
              search_table($(this).val());
          });

          function search_table(value) {
              $('#user_complaint table tbody tr').each(function() {
                 var found = 'false';
                  $(this).each(function() {
                    if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0) {
                        found = 'true';
                    }
                 });
                 if(found == 'true') {
                     $(this).show();
                     clearInterval(time);
                 } else {
                     $(this).hide();
                 }
              });
          }

          setInterval(function() {
        	$('.x_contents').load('f/get_complaint.php');
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

        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
              dom: "Bfrtip",
              responsive: true
            });
          }
        };

        $('#startDate').daterangepicker({
          singleDatePicker: true,
          startDate: moment().subtract(6, 'days')
        });

        $('#endDate').daterangepicker({
          singleDatePicker: true,
          startDate: moment()
        });


        $('#datatable1').dataTable({bFilter: false, bInfo: false, "bLengthChange": false, "lengthMenu": [5]});
        $('#datatable2').dataTable({bFilter: false, bInfo: false, "bLengthChange": false, "lengthMenu": [5]});
        $('#datatable3').dataTable({bFilter: false, bInfo: false, "bLengthChange": false, "lengthMenu": [5]});
        $('#datatable4').dataTable({bFilter: false, bInfo: false, "bLengthChange": false, "lengthMenu": [5]});
        $('#datatable5').dataTable();
        $('#datatable6').dataTable({bFilter: false, bInfo: false, "bLengthChange": false, "lengthMenu": [5]});

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
	var input = document.getElementById("notify");
	var text = input.innerHTML;
	console.log(text + "ok");
        // TableManageButtons.init();
      });
		// setInterval('ajaxcall()', 1000);
		// function ajaxcall() {
		// 		$.ajax({
		// 			type: "GET",
		// 			url: 'f/get_complaint_count.php',
		// 			dataType: 'html'
		// 			success: function(response) {
		// 				json_object = JSON.parse(response)
		// 				var count = json_object.count
		// 				$('#notify').html(count);
		// 			}
		// 		});	
		// 	}
    </script>
	<!-- /Datatables -->
	<script type="text/javascript">
	function ajaxcall() {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if(xhttp.readyState == 4 && xhttp.status == 200) {
				json_object = JSON.parse(xhttp.responseText)
				var count = json_object.count
				$('#notify').html(count);
			}
		};
		xhttp.open('GET', 'f/get_complaint_count.php', true);
		xhttp.send();
		setTimeout(ajaxcall, 1000);
	}
	</script>
</body>
</html>