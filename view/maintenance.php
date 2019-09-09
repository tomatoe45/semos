<?php include 'components/header.php'; ?>
<!-- iCheck -->
<link href="../assets/iCheck/skins/flat/green.css" rel="stylesheet">
<!-- Datatables -->
<link	href="../assets/datatables.net-bs/css/dataTables.bootstrap.min.css"	rel="stylesheet">
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

					<div class="page-title">
						<div class="title_left">
							<h1 align="center">DAILY / MAINTENANCE TASKS</h1>
						</div>
						<div class="title_right">
							<a href="#m_d_t" data-toggle="modal" class="btn btn-success btn-sm pull-right">
								<i class="fa fa-plus"></i> NEW
							</a>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel control_table">
								<div class="x_title">
									<h2>TASK LISTS</h2>
                    <form action="" method="post" class="form-horizontal">
                       <ul class="nav navbar-right panel_toolbox">
                         <li>
                          <div class="row">
                            
                            <div class="col-md-6 pull-right">
                               <div class="input-group">
                                 <input type="text" name="fromdate" class="form-control" id="startDate" value="2016-10-02" data-toggle="tooltip" data-placement="top" title="Date Filter: FROM">
                                 <span class="input-group-addon" data-toggle="tooltip" data-placement="top" title="TO">TO</span>
                                 <input type="text" name="todate" class="form-control col-sm-12 col-xs-12" id="toDate" value="2016-10-08" data-toggle="tooltip" data-placement="top" title="Date Filter : TO DATE">
                                <div class="input-group-btn">
                                  <button type="submit" name="search" data-toggle="tooltip" data-placement="top" title="Search" class="btn btn-default"><i class="fa fa-search"></i></button>
                                  <a href="maintenance.php" data-toggle="tooltip" data-placement="top" title="Refresh" class="btn btn-default"><i class="fa fa-refresh"></i></a>
                                </div>
                               </div>
                            </div>
                          </div>
                         </li>
                       </ul>
                    </form>
                  <?= $session->message; ?>
									<div class="clearfix"></div>
								</div>
                <?php
                    global $database;

                    $tableContent = '';
                    $start = '';
                    $today = date('Y-m-d h:i A');
                    $selectStmt = $database->prepare("SELECT t.*, u.*, ct.*, st.*, cc.* FROM " . TBL_TASK . " t 
                                                      INNER JOIN " . TBL_USERS . " u ON t.user_id = u.user_id
                                                      INNER JOIN " . TBL_COMP . " ct ON t.cat_comp_id = ct.cat_comp_id
                                                      INNER JOIN " . TBL_SPEC . " st ON t.cat_spec_id = st.cat_spec_id
                                                      INNER JOIN " . TBL_CONC . " cc ON t.cat_con_id  = cc.cat_con_id
                                                      WHERE date_format(exec_date, '%Y-%m-%d') = '".date('Y-m-d', strtotime($today))."' ");
                    $selectStmt->execute();
                    $tasked = $selectStmt->fetchAll();

                    foreach ($tasked as $tk){
                      $tableContent = $tableContent   . "<tr>"
                                                      . ( $tk['cat_comp_id'] == '3' ? "<td class='main_comp' align='center'>" : "<td class='it_comp' align='center'>" ) 
                                                      . "<span class='btn btn-danger btn-outline btn-rounded'>" . $tk['task_id'] . "</span></td>"
                                                      . "<td>" . strtoupper($tk['task_subject']) . "</td>"
                                                      . "<td>" . date('M. d Y h:i A', strtotime($tk['exec_date'])) . "</td>"
                                                      . "<td>" . ucwords($tk['firstname'] . ' ' . $tk['lastname']) . "</td>"
                                                      . "<td>" . ( $tk['exec_name'] ? "<span data-toggle='tooltip' data-placement='top' title='Maintenance User'>". ucwords($tk['exec_name']) . "</span>"
                                                                 : "<span data-toggle='tooltip' data-placement='top' title='Registered User'>&hellip;</span>" ). "</td>"
                                                      . "<td>" . ($tk['status'] == '1' ? "<span class='btn btn-success btn-xs col-md-12'><i class='fa fa-check-square-o'></i> RESOLVED</span>" 
                                                                                       : "<span class='btn btn-danger btn-xs col-md-12'><i class='fa fa-times'></i> PENDING</span>") . "</td>"
                                                      . "<td align='center'>"
                                                        . "<a href='#m_t_v". $tk['task_id'] ."' data-toggle='modal' class='btn btn-success btn-xs'><i class='fa fa-eye'></i></a>"
                                                        . ($tk['user_id'] == $session->id ? "<a href='#u_t_u". $tk['task_id'] ."' data-toggle='modal' class='btn btn-primary btn-xs'><i class='fa fa-edit'></i></a>" : "")
                                                        . ($session->isAdmin() ? "<a href='f/remove_task.php?task_id=" . $tk['task_id'] . "' data-toggle='modal' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i></a>" : "" )
                                                      . "</td>"
                                                    . "</tr>"; 
                        include 'modal/modal_u_t_u.php';
                        include 'modal/modal_u_t_u_t.php';
                        include 'modal/modal_m_t_v.php';
        
                    }

                    if(isset($_POST['search'])) {
                      $start = date('Y-m-d', strtotime($_POST['fromdate']));
                      $end = date('Y-m-d', strtotime($_POST['todate']));
                      $tableContent = '';
                      $selectStmt = $database->prepare("SELECT t.*, u.*, ct.*, st.*, cc.* FROM " . TBL_TASK . " t 
                                                      INNER JOIN " . TBL_MAIN_USERS . " u ON t.user_id = u.m_id
                                                      INNER JOIN " . TBL_COMP . " ct ON t.cat_comp_id = ct.cat_comp_id
                                                      INNER JOIN " . TBL_SPEC . " st ON t.cat_spec_id = st.cat_spec_id
                                                      INNER JOIN " . TBL_CONC . " cc ON t.cat_con_id  = cc.cat_con_id 
                                                      WHERE DATE(exec_date) BETWEEN '$start' AND '$end' "); // 2016-10-07 to 2016-10-10
                      $selectStmt->execute();
                      $tasked = $selectStmt->fetchAll(PDO::FETCH_ASSOC);
                      echo "<div> REPORT FROM : <h3>" . date('M. d Y', strtotime($start)) . " TO " . date('M. d Y', strtotime($end)) .  "</h3></div>";
                      foreach ($tasked as $tk) {
                        $tableContent = $tableContent . "<tr>"
                                                        . ( $tk['cat_comp_id'] == '3' ? "<td class='main_comp' align='center'>" : "<td class='it_comp' align='center'>" ) 
                                                        . "<span class='btn btn-danger btn-outline btn-rounded'>" . $tk['task_id'] . "</span></td>"
                                                        . "<td>" . strtoupper($tk['task_subject']) . "</td>"
                                                        . "<td>" . date('M. d Y h:i A', strtotime($tk['exec_date'])) . "</td>"
                                                        . "<td>" . ucwords($tk['firstname'] . ' ' . $tk['lastname']) . "</td>"
                                                        . "<td>" . ( $tk['exec_name'] ? "<span data-toggle='tooltip' data-placement='top' title='Maintenance User'>". ucwords($tk['exec_name']) . "</span>"
                                                                 : "<span data-toggle='tooltip' data-placement='top' title='Registered User'>&hellip;</span>" ). "</td>"
                                                        . "<td>" . ($tk['status'] == '1' ? "<span class='btn btn-success btn-xs col-md-12'><i class='fa fa-check-square-o'></i> RESOLVED</span>" 
                                                                                         : "<span class='btn btn-danger btn-xs col-md-12'><i class='fa fa-times'></i> PENDING</span>") . "</td>"
                                                        . "<td align='center'>"
                                                          . "<a href='#m_t_v". $tk['task_id'] ."' data-toggle='modal' class='btn btn-success btn-xs'><i class='fa fa-eye'></i></a>"
                                                          . ($tk['user_id'] == $session->id || $session->isAdmin() ? "<a href='#u_t_u". $tk['task_id'] ."' data-toggle='modal' class='btn btn-primary btn-xs'><i class='fa fa-edit'></i></a>" : "")
                                                          . ($session->isAdmin() ? "<a href='f/remove_task.php?task_id=" . $tk['task_id'] . "' data-toggle='modal' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i></a>" : "" )
                                                        . "</td>"
                                                      . "</tr>";
                        include 'modal/modal_u_t_u.php';
                        include 'modal/modal_u_t_u_t.php';
                        include 'modal/modal_m_t_v.php';
                        }

                          
                    }

                ?>
								<div class="x_content">
									<table id="datatable3" class="table table-bordered">
										<thead>
											<tr>
                        <th>ID</th>
												<th>SUBJECT</th>
												<th style="width: 14em;">DATE/TIME EXC</th>
												<th width="140">EXECUTED BY</th>
                        <th>PERFORM BY</th>
												<th style="width: 7em;" align="center">STATUS</th>
												<th width="120" align="center">ACTION</th>
											</tr>
										</thead>
										<tbody>
                      <?= $tableContent; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!-- /row -->

				</div>
			</div>
			<!-- /page content -->
      <?php include 'modal/modal_m_t_d.php'; ?>
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
      <!-- Datarange Picker -->
   <script type="text/javascript" src="../build/daterange/moment.js"></script>
 <script type="text/javascript" src="../build/daterange/daterangepicker.js"></script>
	<!-- Datatables -->


	<script src="../assets/datatables.net/js/jquery.dataTables.min.js"></script>
	<script	src="../assets/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

	<!-- Custom Theme Scripts -->
	<script src="../build/js/custom.min.js"></script>

	<!-- Datatables -->
	<script>
      $(document).ready(function() {
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

        $('#toDate').daterangepicker({
          singleDatePicker: true,
          startDate: moment()
        });

         $('#ec_date').daterangepicker({
          singleDatePicker: true,
          startDate: moment().subtract(6, 'days')
        });

        $('#datatable3').dataTable({bFilter: false, bInfo: false, "bLengthChange": false, "lengthMenu": [15]});
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

        //TableManageButtons.init();
      });
    </script>
	<!-- /Datatables -->
</body>
</html>