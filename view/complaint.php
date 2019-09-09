<?php include 'components/header.php'; ?>
<!-- iCheck -->
<link href="../assets/iCheck/skins/flat/green.css" rel="stylesheet">
<!-- Datatables -->
<link href="../assets/datatables.net-bs/css/dataTables.bootstrap.min.css"	rel="stylesheet">
<link	href="../assets/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link	href="../assets/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
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

					<div class="row">

						<div class="col-md-12 col-sm-12 col-xs-12">
            <?php if( ($session->logged_in && $session->isAdmin()) || ($session->logged_in && $session->isMaster()) ) { ?>
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
            <?php } else if($session->logged_in && $session->isExpert()) { ?>
              <div class="">
                <div class="page-title">
            <div class="title_left">
              <h2>COMPLAINT TRACKING SHEET</h2>
            </div>
            <form action="" method="post" class="form-horizontal hide">
              <div class="title_right">
                <div class="col-md-8 col-sm-5 col-xs-12 form-group pull-right">
                  <div class="input-group">
                    <input type="text" name="fromdate" class="form-control" id="startDate" value="2012-04-05">
                     <span class="input-group-addon">to</span> 
                     <input type="text" name="todate" class="form-control" id="endDate" value="2012-04-19"> <span class="input-group-btn">
                      <button class="btn btn-default" type="submit" name="filter_dash">
                        <i class="fa fa-search"></i>
                      </button>
                    </span>
                  </div>
                </div>
              </div>
            </form>
          </div>

          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel control_table">
                <div class="x_title">
                  <h2>COMPLAINT TABLE</h2>

                  <a href="#mk_c_m" class="btn btn-success btn-xs pull-right"
                    data-toggle="modal" data-placement="top" title="New Complaint">
                    <i class="fa fa-plus"></i> New
                  </a>

                  <div class="clearfix"></div><?= $session->message; ?>
                </div>
                <div class="x_content">
                  <table id="datatable1" class="table table-hover table-responsive">
                    <thead>
                      <tr>
                        <th data-toggle="tooltip" data-placement="top"  title="Complaint ID">ID</th>
                        <th data-toggle="tooltip" data-placement="top"  title="Subject of the Complaint">SUBJECT</th>
                        <th data-toggle="tooltip" data-placement="top"  title="Description of the Complaint">COMPLAINT TYPE</th>
                        <th data-toggle="tooltip" data-placement="top"  title="Assisted Complaint"><i class="fa fa-shield"></i> ASSISTED BY</th>
                        <th data-toggle="tooltip" data-placement="top"  title="Status">STATUS</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($user_d_c as $c) {  ?>
                    <tr>
                      <?php if($c['cat_comp_id'] == '3' ) { echo "<td class='main_comp c_id' width='50' align='center'>"; } else { echo "<td class='it_comp c_id' width='50' align='center'>"; } ?>
                        <span class='btn btn-rounded btn-danger btn-outline btn-sm'><strong><?= $c['comp_id']; ?></strong></span></td>
                      <td>
                        <a href="#c_details<?= $c['comp_id'] ?>"  data-toggle="modal" class="btn btn-primary btn-rounded btn-outline btn-xs"> 
                          <i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="View Details"></i></a>
                           <?= ucfirst($c['subject']); ?>
                        </td>
                      <td width="300" align="center"><?= strtoupper($c['cat_complaint']); ?></td>
                      <td width="150"><?=$c ['assisted'] ? "<button type='button' class='btn btn-success btn-xs col-md-12 col-sm-12 col-xs-12'><i class='fa fa-shield'></i> " . ucwords ( $c ['assisted'] ) . "</button>" : "<button type='button' class='btn btn-success btn-xs col-md-12 col-sm-12 col-xs-12'><i class='fa fa-spinner fa-spin'></i> REQUESTING&hellip;</button>";?></td>
                      <td width="90"><?=$c ['status'] == 0 ? "<a href='#c_toggle" . $c ['comp_id'] . "' data-toggle='modal' class='btn btn-default btn-xs col-md-12 col-sm-12 col-xs-12'>
                          <i class='fa fa-spinner fa-spin'></i> PROCESSING&hellip;</a>" : ($c ['status'] == 1 ? "<a href='#c_toggle" . $c ['comp_id'] . "' data-toggle='modal' class='btn btn-info btn-xs col-md-12 col-sm-12 col-xs-12'><i class='fa fa-comments-o'></i> ASSISTED</button>" : ($c ['status'] == 2 ? "<a href='#c_toggle" . $c ['comp_id'] . "' data-toggle='modal' class='btn btn-warning btn-xs col-md-12 col-sm-12 col-xs-12'><i class='fa fa-exclamation-triangle'></i> PENDING</a>" : ($c ['status'] == 5 ? "<a href='#c_toggle" . $c ['comp_id'] . "' data-toggle='modal' class='btn btn-success btn-xs col-md-12 col-sm-12 col-xs-12'><i class='fa fa-check-square-o'></i> RESOLVED</button>" : "")));?></td>
                      <?php
                        include 'modal/modal_c_toggle.php';
                        include 'modal/modal_c_details.php';
                        ?>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
              </div>
            <?php } ?>

						</div>

					</div>

				</div>
			</div>
			<!-- /page content -->
			<!-- Modal Include -->
<?php include 'modal/modal_mk_c.php'; ?>
			<!-- /Modal Include -->
			<!-- footer content -->
			<footer>
          <?php include 'components/footer.php'; ?>
        </footer>
			<!-- /footer content -->
		</div>
	</div>
  <script type="text/javascript" src="../build/jquery-3.1.1.js"></script> 
	<!-- jQuery -->
	<script src="../assets/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="../assets/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- FastClick -->
	<script src="../assets/fastclick/lib/fastclick.js"></script>
	<!-- NProgress -->
	<script src="../assets/nprogress/nprogress.js"></script>
	<!-- Datatables -->
        <!-- Datarange Picker -->
   <script type="text/javascript" src="../build/daterange/moment.js"></script>
 <script type="text/javascript" src="../build/daterange/daterangepicker.js"></script>
  <!-- Datatables -->
	<script src="../assets/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="../assets/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

	<!-- Custom Theme Scripts -->
	<script src="../build/js/custom.min.js"></script>

	<!-- Datatables -->
	<script>
      $(document).ready(function() {
       
       setInterval(function() {
        $('.x_contents').load('f/get_complaint.php');
       }, 1000);
    
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
        $('#datatable-keytable').DataTable({
          keys: true
        });

          $('#startDate').daterangepicker({
          singleDatePicker: true,
          startDate: moment().subtract(6, 'days')
        });

        $('#endDate').daterangepicker({
          singleDatePicker: true,
          startDate: moment()
        });
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
              dom: "Bfrtip",
              responsive: true
            });
          }
        };

        $('#datatable1').dataTable({bFilter: false, bInfo: false, "bLengthChange": false, "lengthMenu": [5]});
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

        // TableManageButtons.init();
      });
    </script>
	<!-- /Datatables -->

</body>
</html>