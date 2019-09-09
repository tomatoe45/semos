<?php include 'components/header.php'; ?>
<!-- iCheck -->
<link href="../assets/iCheck/skins/flat/green.css" rel="stylesheet">
<!-- Datatables -->
<link	href="../assets/datatables.net-bs/css/dataTables.bootstrap.min.css"	rel="stylesheet">
<link	href="../assets/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link	href="../assets/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">


<style type="text/css" media="screen">
  .btn_status {
    height: 80px;
    padding-top: 10px;
  }  
  #cc_id_p {
    padding-top: 5em;
  }

</style>

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
          <?php
              global $database;
              $tableContent = '';
              $start = '';
              $strt = '';
              $selectStmt = $database->prepare("SELECT c.*, d.*, u.*, ct.*, st.*, cc.* FROM ".TBL_COMPLAINT." c 
                                                INNER JOIN ".TBL_DEPT." d ON c.dept_id = d.dept_id
                                                INNER JOIN ".TBL_USERS." u ON c.user_id = u.user_id 
                                                INNER JOIN " . TBL_COMP . " ct ON c.cat_comp_id = ct.cat_comp_id
                                                INNER JOIN " . TBL_SPEC . " st ON c.cat_spec_id = st.cat_spec_id
                                                INNER JOIN " . TBL_CONC . " cc ON c.cat_con_id  = cc.cat_con_id
                                                WHERE c.status BETWEEN '2' AND '5' ORDER BY comp_id DESC");
              $selectStmt->execute();
              $l_comp = $selectStmt->fetchAll();

              foreach ($l_comp as $lc){
                $tableContent = $tableContent . "<tr>"
                                             . ( $lc['cat_comp_id'] == '3' ?
                                                    '<td class="main_comp" width="150" align="center">' :
                                                    '<td class="it_comp" width="150" align="center">' )
                                              . "<p id='cc_id_p'><span class='btn btn-rounded btn-danger btn-outline btn-sm cc_id'><strong> " . $lc['comp_id'] . "</strong></span></p></td>"
                                              . "<td>"
                                              . "<div class='messages'>" 
                                                . "<div class='message_wrapper'>"
                                                  . "<h5 class='heading'>SUBJECT</h5>"
                                                    . "<p class='content_details'>" . ucfirst(strtolower($lc['subject'])) . "</p>"
                                                  . "<h5 class='heading'>DESCRIPTION</h5>"
                                                    . "<p class='content_details'>" . ucfirst(strtolower($lc['description'])) . "</p>"
                                                  . "<h5 class='heading'>REMARKS</h5>"
                                                    . "<p class='content_details'>" . ucfirst(strtolower($lc['remarks'])) . "</p>"
                                                    . "<p class='url'>"
                                                      . "<span class='fs1 text-info' aria-hidden='true'></span>"
                                                      . "<a data-toggle='tooltip' data-placement='top' title='Complainant Name'><i class='fa fa-users'></i> " . ucwords(strtolower($lc['firstname'] . ' ' . $lc['lastname'])) . "</a>"
                                                      
                                                      . "<span class='fs1 text-info' aria-hidden='true'></span> &nbsp;&nbsp;"
                                                      . "<a data-toggle='tooltip' data-placement='top' title='Complainant Department'><i class='fa fa-hospital-o'></i> " . ucwords(strtolower($lc['dept_name'])) . "</a>"
                                                      
                                                      . "<span class='fs1 text-info' aria-hidden='true'></span> &nbsp;&nbsp;"
                                                      . "<a data-toggle='tooltip' data-placement='top' title='Requested Date'><i class='fa fa-clock-o'></i> " . date('M. d Y', strtotime($lc['req_date'])) . "</a>"
                                                      
                                                      . "<span class='fs1 text-info' aria-hidden='true'></span> &nbsp;&nbsp;"
                                                      . "<a href='#'><i class='fa fa-paperclip'></i> Attachment : " . ($lc['file'] ? "<a href='download.php?file=" . $lc['file'] . "' data-toggle='tooltip' data-placement='top' title='Download Attachment File'><i class='fa fa-download'></i></a>" 
                                                                                                                                   : "<i class='fa fa-unlink' data-toggle='tooltip' data-placement='top' title='No File Attach'></i>")
                                                    . "</p>"
                                                . "</div>"
                                              . "</div></td>" 
                                              . "<td align='center' width='120'>"
                                              . ($lc['status'] == '2' ? "<a href='#c_h_r" . $lc['comp_id'] . "' data-toggle='modal' class='btn btn-lg btn-warning col-md-12 btn_status'><i class='fa fa-hand-o-up'></i> <br>PENDING</a>"
                                                                      : ($lc['status'] == '5' ? "<a href='#c_h_r". $lc['comp_id'] ."' data-toggle='modal' class='btn btn-lg btn-success col-md-12 btn_status'><i class='fa fa-hand-o-up'></i> <br>DONE</a>" : ""))
                                              . ( ($lc['status'] != '5') && ( $session->isAdmin() ) ? "<a href='#assisted_claimed".$lc['comp_id']."' data-toggle='modal' class='btn btn-danger btn-xs col-md-12 acts'><i class='fa fa-cog'></i></a>"
                                                                      : "")
                                              . "</td>"
                                              ."</tr>";
                                              include 'modal/modal_c_h_r.php';
                                              include 'modal/modal_c_h_u.php';
              }

            if(isset($_POST['search'])) {
              $start = $_POST['stats_res'];
              $strt = $_POST['c_type'];
              $tableContent = '';
              $selectStmt = $database->prepare("SELECT c.*, d.*, u.*, ct.*, st.*, cc.* FROM ".TBL_COMPLAINT." c 
                                                INNER JOIN ".TBL_DEPT." d ON c.dept_id = d.dept_id
                                                INNER JOIN ".TBL_USERS." u ON c.user_id = u.user_id 
                                                INNER JOIN " . TBL_COMP . " ct ON c.cat_comp_id = ct.cat_comp_id
                                                INNER JOIN " . TBL_SPEC . " st ON c.cat_spec_id = st.cat_spec_id
                                                INNER JOIN " . TBL_CONC . " cc ON c.cat_con_id  = cc.cat_con_id
                                                WHERE c.status LIKE '%".$start."%' 
                                                                AND ct.cat_complaint LIKE '%".$strt."%' 
                                                                AND c.status BETWEEN '2' AND '5' ");
              $selectStmt->execute(array(':start'=>$start.'%', ':start' => $strt.'%'));
              $l_comp = $selectStmt->fetchAll();

              foreach ($l_comp as $lc) {
                $tableContent = $tableContent . "<tr>"
                                             . ( $lc['cat_comp_id'] == '3' ? "<td class='main_comp' width='150' align='center'>" : "<td class='it_comp' width='150' align='center'>" ) 
                                              . "<p id='cc_id_p'><span class='btn btn-rounded btn-danger btn-outline btn-sm cc_id'><strong> " . $lc['comp_id'] . "</strong></span></p></td>"
                                                . "<td><div class='messages'>" 
                                                . "<div class='message_wrapper'>"
                                                  . "<h5 class='heading'>SUBJECT</h5>"
                                                    . "<p class='content_details'>" . ucfirst(strtolower($lc['subject'])) ."</p>"
                                                  . "<h5 class='heading'>DESCRIPTION</h5>"
                                                    . "<p class='content_details'>" . ucfirst(strtolower($lc['description'])) . "</p>"
                                                  . "<h5 class='heading'>REMARKS</h5>"
                                                    . "<p class='content_details'>" . ucfirst(strtolower($lc['remarks'])) . "</p>"
                                                    . "<p class='url'>"
                                                      . "<span class='fs1 text-info' aria-hidden='true'></span>"
                                                      . "<a data-toggle='tooltip' data-placement='top' title='Complainant Name'><i class='fa fa-users'></i> " . ucwords(strtolower($lc['firstname'] . ' ' . $lc['lastname'])) . "</a>"
                                                      
                                                      . "<span class='fs1 text-info' aria-hidden='true'></span> &nbsp;&nbsp;"
                                                      . "<a data-toggle='tooltip' data-placement='top' title='Complainant Department'><i class='fa fa-hospital-o'></i> " . ucwords(strtolower($lc['dept_name'])) . "</a>"
                                                      
                                                      . "<span class='fs1 text-info' aria-hidden='true'></span> &nbsp;&nbsp;"
                                                      . "<a data-toggle='tooltip' data-placement='top' title='Requested Date'><i class='fa fa-clock-o'></i> " . date('M. d Y', strtotime($lc['req_date'])) . "</a>"
                                                      
                                                      . "<span class='fs1 text-info' aria-hidden='true'></span> &nbsp;&nbsp;"
                                                      . "<a href='#'><i class='fa fa-paperclip'></i> Attachment : " . ($lc['file'] ? "<a href='download.php?file=" . $lc['file'] . "' data-toggle='tooltip' data-placement='top' title='Download Attachment File'><i class='fa fa-download'></i></a>" 
                                                                                                                                   : "<i class='fa fa-unlink' data-toggle='tooltip' data-placement='top' title='No File Attach'></i>")
                                                    . "</p>"
                                                . "</div>"
                                              . "</div></td>" 
                                              . "<td align='center' width='120'>"
                                              . ($lc['status'] == '2' ? "<a href='#c_h_r" . $lc['comp_id'] . "' data-toggle='modal' class='btn btn-lg btn-warning col-md-12 btn_status'><i class='fa fa-hand-o-up'></i> <br>PENDING</a>"
                                                                      : ($lc['status'] == '5' ? "<a href='#c_h_r". $lc['comp_id'] ."' data-toggle='modal' class='btn btn-lg btn-success col-md-12 btn_status'><i class='fa fa-hand-o-up'></i> <br>DONE</a>" : ""))
                                              . ( ($lc['status'] != '5') && ( $session->isAdmin() ) ? "<a href='#assisted_claimed".$lc['comp_id']."' data-toggle='modal' class='btn btn-danger btn-xs col-md-12 acts'><i class='fa fa-cog'></i></a>"
                                                                      : "")
                                              . "</td>"
                                              ."</tr>";
                                              include 'modal/modal_c_h_r.php';
                                              include 'modal/modal_c_h_u.php';
                                              
              }
                  
            }

          ?>

					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel control_table">
                  <div class="title_left">
                    <?= $session->message; ?>
                  </div>
								<div class="x_title form-group top-search">
									<h2><i class="fa fa-filter" data-toggle="tooltip" data-placement="top" title="Filter"></i> COMPLAINT HISTORY AND RESPONSE</h2>
									<form action="" method="post" class="form-horizontal">
                    <ul class="nav navbar-right panel_toolbox col-md-2" data-toggle="tooltip" data-placement="top" title="FILTER: COMPLAINT STATUS">
                      <li>
                        <div class="input-group">
                          <select name="stats_res" class="form-control status">
                            <option value=""  >ALL</option>
                            <option value="2" <?php if($start == '2') {echo 'selected';} ?>  >PENDING</option>
                            <option value="5" <?php if($start == '5') {echo 'selected';} ?>  >RESOLVED</option>
                          </select>
                          <div class="input-group-btn">
                            <button type="submit" name="search" class="btn btn-default"><i class="fa fa-search"></i></button>
                          </div>
                        </div>
                      </li>
                    </ul>
                    <ul class="nav navbar-right panel_toolbox col-md-3" data-toggle="tooltip" data-placement="top" title="FILTER: COMPLAINT TYPE">
  										<li>
                          <div>
                            <select name="c_type" class="form-control status col-md-12">
                              <option value="">ALL</option>
                              <option value="BIOMEDICAL COMPLAINTS" <?php if($strt == 'BIOMEDICAL COMPLAINTS') {echo 'selected';} ?>>BIOMEDICAL COMPLAINTS</option>
                              <option value="I.T. ISSUES" <?php if($strt == 'I.T. ISSUES') {echo 'selected';} ?>>I.T. ISSUES</option>
                              <option value="MAINTENANCE CONCERNS" <?php if($strt == 'MAINTENANCE CONCERNS') {echo 'selected';} ?>>MAINTENANCE CONCERNS</option>
                            </select>
                          </div>
  										</li>
  									</ul>
                  </form>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<table id="datatable4" class="table table-hover">
										<thead>
											<tr>
                                                <th>COMPLAINT ID</th>
												<th>DESCRIPTION</th>
												<th>ACTION</th>
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

	<!-- Custom Theme Scripts -->
	<script src="../build/js/custom.min.js"></script>

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


        $('#datatable1').dataTable({bFilter: false, bInfo: false, "bLengthChange": false, "lengthMenu": [5]});
        $('#datatable2').dataTable({bFilter: false, bInfo: false, "bLengthChange": false, "lengthMenu": [5]});
        $('#datatable3').dataTable({bFilter: false, bInfo: false, "bLengthChange": false, "lengthMenu": [5]});
        $('#datatable4').dataTable({bFilter: false, bInfo: false, "bLengthChange": false, "lengthMenu": [5]});
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