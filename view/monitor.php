<?php include 'components/header.php'; ?>
<!-- iCheck -->
<link href="../assets/iCheck/skins/flat/green.css" rel="stylesheet">
<!-- Datatables -->
<link href="../assets/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../assets/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="../assets/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
  <style type="text/css" media="screen">
    .url_caption{
      font-size: 10px;
    }
  </style>
<body class="nav-md">
<?php if( ($session->logged_in != $session->isAdmin()) && ($session->logged_in != $session->isMaster()) )  { header('Location: dashboard.php?redirect=>home=>user='. $session->firstname);} ?>
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
							<?= $session->message; ?>
						</div>
					</div>
					<div class="clearfix"></div>

					<div class="row">

						<div class="col-md-6 col-sm-12 col-xs-12 animate fadeInUp">
							<div class="x_panel complaint_monitor">
								<div class="x_title">
									<h2>PENDING COMPLAINTS</h2> <br><code>( Biomedical and I.T. Issues Concerns )</code>
									<div class="clearfix"></div>
								</div>
								
								<div class="x_content">
									<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" class="form-horizontal">
  									<table class="table col-md-6 col-sm-12 col-xs-12">
  										<thead>
  											<tr>
  												<th>ID</th>
  												<th>PENDING COMPLAINT DESCRIPTION</th>
  											</tr>
  										</thead>
  										<tbody>
  													<?php foreach ($a_comp as $ac): ?>
  													<?php 
                              global $database;
                              if(isset($_POST['save_'])) {
                                $rem = $_POST['remarks'];
                                $cids = $_POST['cid'];
                                $database->exec("UPDATE " . TBL_COMPLAINT . " SET status = '2', remarks = '$rem' WHERE comp_id = '$cids' ");
                                $session->message("<div class='alert alert-success'><h3>Well Done!</h3> Complaint Successfully Saved.</div>");
                                echo "<script type='text/javascript'>window.location = 'monitor.php?Save Successfully!';</script>";
                              }

                            if(isset($_POST['done_'])) {
                              $rem = $_POST['remarks'];
                              $cids = $_POST['cid'];
                              $database->exec("UPDATE " . TBL_COMPLAINT . " SET status = '5', remarks = '$rem', res_date = NOW() WHERE comp_id = '$cids' ");
                              $session->message("<div class='alert alert-success'><h3>Well Done!</h3> Complaint Successfully Saved.</div>");
                              echo "<script type='text/javascript'>window.location = 'monitor.php?Save Successfully!';</script>";
                            }

                            if(isset($_POST['saves_'])) {
                              $rem = $_POST['remarks'];
                              $cids = $_POST['cid'];
                              $database->exec("UPDATE " . TBL_COMPLAINT . " SET status = '2', remarks = '$rem' WHERE comp_id = '$cids' ");
                              $session->message("<div class='alert alert-success'><h3>Well Done!</h3> Complaint Successfully Saved.</div>");
                              echo "<script type='text/javascript'>window.location = 'monitor.php?Save Successfully!';</script>";
                            }

                            if(isset($_POST['dones_'])) {
                              $rem = $_POST['remarks'];
                              $cids = $_POST['cid'];
                              $database->exec("UPDATE " . TBL_COMPLAINT . " SET status = '5', remarks = '$rem', res_date = NOW() WHERE comp_id = '$cids' ");
                              $session->message("<div class='alert alert-success'><h3>Well Done!</h3> Complaint Successfully Saved.</div>");
                              echo "<script type='text/javascript'>window.location = 'monitor.php?Save Successfully!';</script>";
                            } 
                          ?>
  													<tr>
    													<?php if($ac['cat_comp_id'] == '3' ) { 
    													echo "<td class='main_comp'>"; } else { 
    													echo "<td class='it_comp'>"; } ?>
  													 <span class='btn btn-danger btn-outline btn-rounded'><?= $ac['comp_id']; ?></span>
  													</td>

  													<td>
  													  <div class="messages">
  															<div class="message_wrapper">
  																<h3 class="heading">
  																	<?php if($ac['cat_comp_id'] == '3' && $session->dept == 'maintenance department') { ?>

  																	<button type="submit" name="done_" class="btn btn-xs btn-success pull-right"><i class="fa fa-sign-in"></i> DONE</button>
                                    <button type="submit" name="save_" class="btn btn-xs btn-warning pull-right"><i class="fa fa-save"></i> SAVE</button>

                                    <?php } else if($ac['cat_comp_id'] != '3' && $session->dept != 'maintenance department') { ?>

                                    <button type="submit" name="dones_" class="btn btn-xs btn-success pull-right"><i class="fa fa-sign-in"></i> DONE</button>
                                    <button type="submit" name="saves_" class="btn btn-xs btn-warning pull-right"><i class="fa fa-save"></i> SAVE</button>
                                    
                                    <?php } else {
                                    	echo "<span  class='pull-right'><code>Assisted By:</code> " . $ac['assisted'] . "</span>";
                                    	} ?>
  																</h3>

  																<h3><span data-toggle='tooltip' data-placement='top' title='Complaint Subject'><?= ucfirst($ac['subject']); ?></span></h3>
  																<input type="hidden" name="cid" value="<?= $ac['comp_id']; ?>">
  																<p><span data-toggle='tooltip' data-placement='bottom' title='Complaint Description'><?= ucfirst($ac['description']); ?></span></p>
  																<br>

  																<textarea name="remarks" rows="3" cols="80" class="form-control" placeholder="Enter Remarks&hellip;"></textarea>

  																<br>

  																<p class="url url_caption">
  																	<span class="fs1 text-info" aria-hidden="true"></span>
  	                                <a href="#" data-toggle="tooltip" data-placement="top" title="Complainant Name"><i class="fa fa-user"></i> <?= strtoupper($ac['firstname'] . ' ' . $ac['lastname']); ?> </a>

  																	<span class="fs1 text-info" aria-hidden="true"></span> &nbsp;&nbsp;
  	                                <a href="#" data-toggle="tooltip" data-placement="top" title="Complainant Department"><i class="fa fa-hospital-o"></i> <?= strtoupper($ac['dept_name']); ?> </a> 

  	                                <span	class="fs1 text-info" aria-hidden="true"></span> &nbsp;&nbsp;
  	                                <a href="#" data-toggle="tooltip" data-placement="top" title="Requested Date"><i class="fa fa-clock-o"></i> <?= date('M. d Y', strtotime($ac['req_date'])); ?> </a>

  																	<span class="fs1 text-info" aria-hidden="true"></span> &nbsp;&nbsp;
  	                                 <a	href="#"><i class="fa fa-paperclip"></i> ATTACHMENT : <?=  $ac['file'] ? 
  	                                 "<a href='download.php?file=". $ac['file'] ."' data-toggle='tooltip' data-placement='top' title='Download Attachment File'><i class='fa fa-download'></i></a>" : 
  	                                 "<i class='fa fa-unlink' data-toggle='tooltip' data-placement='top' title='No File Attach'></i>"; ?></a>
  																</p>
  															</div>
  														</div>
  													</td>

  											</tr>
  										<?php endforeach ?>
  										</tbody>
  									</table>
                  </form>
								</div>
							
							</div>
						</div>
						<!-- End Col -->
						<div class="col-md-6 col-sm-12 col-xs-12 animate fadeInUp">
							<div class="x_panel complaint_monitor">
								<div class="x_title">
									<h2>PENDING COMPLAINTS</h2> <br> <code>( Maintenance Concerns Complaints )</code>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" class="form-horizontal">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>PENDING COMPLAINT DESCRIPTION</th>
                        </tr>
                      </thead>
                      <tbody>
                            <?php foreach ($d_comp as $dc): ?>
                            <?php 
                            global $database;
                            if(isset($_POST['save_'])) {
                            $rem = $_POST['remarks'];
                            $cids = $_POST['cid'];
                            $database->exec("UPDATE " . TBL_COMPLAINT . " SET status = '2', remarks = '$rem' WHERE comp_id = '$cids' ");
                            $session->message("<div class='alert alert-success'><h3>Well Done!</h3> Complaint Successfully Saved.</div>");
                            echo "<script type='text/javascript'>window.location = 'monitor.php?Save Successfully!';</script>";
                            }

                            if(isset($_POST['done_'])) {
                            $rem = $_POST['remarks'];
                            $cids = $_POST['cid'];
                            $database->exec("UPDATE " . TBL_COMPLAINT . " SET status = '5', remarks = '$rem', res_date = NOW() WHERE comp_id = '$cids' ");
                            $session->message("<div class='alert alert-success'><h3>Well Done!</h3> Complaint Successfully Saved.</div>");
                            echo "<script type='text/javascript'>window.location = 'monitor.php?Save Successfully!';</script>";
                          }

                           global $database;
                            if(isset($_POST['saves_'])) {
                            $rem = $_POST['remarks'];
                            $cids = $_POST['cid'];
                            $database->exec("UPDATE " . TBL_COMPLAINT . " SET status = '2', remarks = '$rem' WHERE comp_id = '$cids' ");
                            $session->message("<div class='alert alert-success'><h3>Well Done!</h3> Complaint Successfully Saved.</div>");
                            echo "<script type='text/javascript'>window.location = 'monitor.php?Save Successfully!';</script>";
                            }

                            if(isset($_POST['dones_'])) {
                            $rem = $_POST['remarks'];
                            $cids = $_POST['cid'];
                            $database->exec("UPDATE " . TBL_COMPLAINT . " SET status = '5', remarks = '$rem', res_date = NOW() WHERE comp_id = '$cids' ");
                            $session->message("<div class='alert alert-success'><h3>Well Done!</h3> Complaint Successfully Saved.</div>");
                            echo "<script type='text/javascript'>window.location = 'monitor.php?Save Successfully!';</script>";
                          } 
                          ?>
                            <tr>
                            <?php if($dc['cat_comp_id'] == '3' ) { 
                            echo "<td class='main_comp'>"; } else { 
                            echo "<td class='it_comp'>"; } ?>
                            <span class='btn btn-danger btn-outline btn-rounded'><?= $dc['comp_id']; ?></span>
                            </td>

                            <td>
                            <div class="messages col-md-12">
                                <div class="message_wrapper">
                                  <h3 class="heading">
                                    <?php if($dc['cat_comp_id'] == '3' && $session->dept == 'maintenance department') { ?>
                                    <button type="submit" name="done_" class="btn btn-xs btn-success pull-right"><i class="fa fa-sign-in"></i> DONE</button>
                                    <button type="submit" name="save_" class="btn btn-xs btn-warning pull-right"><i class="fa fa-save"></i> SAVE</button>

                                    <?php } else if($dc['cat_comp_id'] != '3' && $session->dept != 'maintenance department') { ?>

                                    <button type="submit" name="dones_" class="btn btn-xs btn-success pull-right"><i class="fa fa-sign-in"></i> DONE</button>
                                    <button type="submit" name="saves_" class="btn btn-xs btn-warning pull-right"><i class="fa fa-save"></i> SAVE</button>
                                    <?php } else {
                                      echo "<span  class='pull-right'><code>Assisted By:</code> " . $dc['assisted'] . "</span>";
                                      } ?>
                                  </h3>

                                  <h3><span data-toggle='tooltip' data-placement='top' title='Complaint Subject'><?= ucfirst($dc['subject']); ?></span></h3>
                                  <input type="hidden" name="cid" value="<?= $dc['comp_id']; ?>">
                                  <p><span data-toggle='tooltip' data-placement='bottom' title='Complaint Description'><?= ucfirst($dc['description']); ?></span></p>
                                  <br>
                                  <textarea name="remarks" rows="3" cols="80" class="form-control" placeholder="Enter Remarks&hellip;"></textarea>

                                  <br>
                                  <p class="url url_caption">
                                    <span class="fs1 text-info" aria-hidden="true"></span>
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Complainant Name"><i class="fa fa-user"></i> <?= strtoupper($dc['firstname'] . ' ' . $dc['lastname']); ?> </a>

                                    <span class="fs1 text-info" aria-hidden="true"></span> &nbsp;&nbsp;
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Complainant Department"><i class="fa fa-hospital-o"></i> <?= strtoupper($dc['dept_name']); ?> </a> 

                                    <span class="fs1 text-info" aria-hidden="true"></span> &nbsp;&nbsp;
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Requested Date"><i class="fa fa-clock-o"></i> <?= date('M. d Y', strtotime($dc['req_date'])); ?> </a>

                                    <span class="fs1 text-info" aria-hidden="true"></span> &nbsp;&nbsp;
                                     <a href="#"><i class="fa fa-paperclip"></i> ATTACHMENT : <?=  $dc['file'] ? 
                                     "<a href='download.php?file=". $dc['file'] ."' data-toggle='tooltip' data-placement='top' title='Download Attachment File'><i class='fa fa-download'></i></a>" : 
                                     "<i class='fa fa-unlink' data-toggle='tooltip' data-placement='top' title='No File Attach'></i>"; ?></a>
                                  </p>
                                </div>
                              </div>
                            </td>

                        </tr>
                      <?php endforeach ?>
                      </tbody>
                    </table>
                  </form>
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
	<script	src="../assets/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

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

        $('#datatable6').dataTable({bFilter: false, bInfo: false, "bLengthChange": false, "lengthMenu": [5]});
        $('#datatable7').dataTable({bFilter: false, bInfo: false, "bLengthChange": false, "lengthMenu": [5]});
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