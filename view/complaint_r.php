<?php include 'components/header.php'; ?>
<?php

if (! isset ( $_GET ['comp_id'] )) {
	header ( 'Location: complaint.php' );
}

global $database;
$id = $_GET ['comp_id'];

try {
	$que = "SELECT c.*, d.*, u.*, ct.*, st.*, cc.*  FROM " . TBL_COMPLAINT . " c
      INNER JOIN " . TBL_DEPT . " d ON c.dept_id      = d.dept_id
      INNER JOIN " . TBL_USERS . " u ON c.user_id      = u.user_id
      INNER JOIN " . TBL_COMP . " ct ON c.cat_comp_id = ct.cat_comp_id
      INNER JOIN " . TBL_SPEC . " st ON c.cat_spec_id = st.cat_spec_id
      INNER JOIN " . TBL_CONC . " cc ON c.cat_con_id  = cc.cat_con_id WHERE comp_id = '$id'";
	$q = $database->query ( $que );
	$q->setFetchMode ( PDO::FETCH_ASSOC );
} catch ( Exception $e ) {
	die ( "Error " . $e->getMessage () );
}
?>
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

					<div class="row">

						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel control_table">
								<div class="x_title">
									<h2>COMPLAINT REVIEW</h2>
									<div class="clearfix"></div>
								</div>
								<form action="" method="post" class="form">
									<div class="x_content">
                  <?php while ($uc = $q->fetch()) : ?>
                  <div class="form-body">

											<div class="row">
												<div class="col-md-4 pull-left">
													<div class="form-group">
														<label for="" class="control-label">Complainant Name</label>
														<input type="text" class="form-control" name="cname"
															value="<?= ucwords(strtolower($uc['firstname'] . ' ' . $uc['lastname'])); ?>"
															readonly="readonly" /> <input type="hidden"
															class="form-control" name="cid"
															value="<?= $uc['comp_id']; ?>">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="" class="control-label">Department :</label> <input
															type="text" class="form-control" name="dept"
															value="<?= $uc['dept_name'] ?>" readonly="readonly" />
													</div>
												</div>
												<div class="col-md-4 pull-right">
													<div class="form-group">
														<label for="" class="control-label">Ticket No.:</label> <input
															type="text" class="form-control" name="ticket"
															value="<?= $uc['ticket'] ?>" readonly="readonly" />
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label for="" class="control-label">Complaint Type:</label>
														<input type="text" class="form-control" name="ctype"
															value="<?= $uc['cat_complaint'] ?>" readonly="readonly" />
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="" class="control-label">Spicific Complaint:</label>
														<input type="text" class="form-control" name="stype"
															value="<?= $uc['cat_specific']; ?>" readonly="readonly" />
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="" class="control-label">Concern Type:</label>
														<input type="text" class="form-control" name="concern"
															value="<?= $uc['cat_concern']; ?>" readonly="readonly" />
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label for="" class="control-label">Subject:</label> <input
															type="text" class="form-control" name="subject"
															value="<?= $uc['subject']; ?>" readonly="readonly" />
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label for="" class="control-label">Description:</label>
														<textarea name="descript" rows="5"
															class="form-control scroller" readonly="readonly"><?= ucfirst($uc['description']); ?></textarea>
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label for="" class="control-label">Attachment: </label> <a
															href="#" class="control-label"><?=$uc ['file'] ? "<a href='download.php?file=" . $uc ['file'] . "' data-toggle='tooltip' data-placement='top' title='Download Attachment File'><i class='fa fa-download'></i></a>" : "<i class='fa fa-unlink' data-toggle='tooltip' data-placement='top' title='No File Attach'></i>";?></a>
													</div>

												</div>
												<div class="col-md-4 pull-right">
													<div class="form-group">
                          <?php if($uc['cat_comp_id'] == '3') { ?>

                          <select name="assist_name"
															class="form-control" required="required">
															<option
																value="<?= $session->firstname . ' ' .$session->lastname; ?>"
																selected="selected"><?= strtoupper($session->firstname) . ' ' .strtoupper($session->lastname); ?></option>
															<option value="">ASSISTED BY (SELECT MAINTENANCE USER)</option>
                          <?php foreach ($mnt_users as $mu): ?>
                            <option
																value="<?= ucwords($mu['firstname'] . ' ' . $mu['lastname']); ?>"><?= strtoupper($mu['firstname'] . " " . $mu['lastname']); ?></option>
                          <?php endforeach ?>
                          </select>

                          <?php } else { ?>

                          <select name="assist_name"
															class="form-control" required="required">
															<option
																value="<?= $session->firstname . ' ' .$session->lastname; ?>"
																selected="selected"><?= strtoupper($session->firstname) . ' ' .strtoupper($session->lastname); ?></option>
															<option value="" disabled="disabled">ASSISTED BY (PLEASE
																SELECT USER)</option>
                            <?php foreach ($t_users as $tu): ?>
                              <option
																value="<?= ucfirst($tu['firstname']); ?> <?= ucfirst($tu['lastname']); ?>"> <?= strtoupper($tu['firstname']); ?> <?= strtoupper($tu['lastname']); ?></option>
                            <?php endforeach ?>
                          </select>
                          <?php } ?>
                        </div>
												</div>
											</div>

											<div class="row">
												<div class="col-md-12">
													<!-- <button type="submit" name="assist" class="btn btn-success btn-outline pull-right"><i class="fa fa-hand-o-up"></i> Assist</button> -->
                        <?php
																			if ($uc ['cat_comp_id'] == '3' && $session->dept == 'maintenance department') {
																				echo "<button type='submit' name='assist' class='btn btn-success btn-outline pull-right'><i class='fa fa-hand-o-up'></i> Assist</button>";
																			} else if ($uc ['cat_comp_id'] != '3' && $session->dept != 'maintenance department') {
																				echo "<button type='submit' name='assist' class='btn btn-success btn-outline pull-right'><i class='fa fa-hand-o-up'></i> Assist</button>";
																			} else {
																				echo "<a href='complaint.php' class='btn btn-success btn-outline pull-right'><i class='fa fa-arrow-circle-left'></i> BACK</a>";
																			}
																			?>
                      </div>
											</div>

										</div>

                <?php endwhile; ?>

                </div>

								</form>
							</div>
						</div>

					</div>

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
	<script type="text/javascript" src="../build/jquery-3.1.1.js"></script>
	<!-- jQuery -->
	<script src="../assets/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="../assets/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- FastClick -->
	<script src="../assets/fastclick/lib/fastclick.js"></script>
	<!-- NProgress -->
	<script src="../assets/nprogress/nprogress.js"></script>
	<!-- Custom Theme Scripts -->
	<script src="../build/js/custom.min.js"></script>
	<script type="text/javascript">
  $(document).ready(function() {
     setInterval(function() {
          $('#notify').load('f/get_complaint_count.php');
        }, 1000);
   });
</script>

</body>
</html>

<?php
global $database;
$id = $_GET ['comp_id'];
if (isset ( $_POST ['assist'] )) {
	$name = $_POST ['assist_name'];
	$database->exec ( "UPDATE " . TBL_COMPLAINT . " SET status = '1', assisted = '$name' WHERE comp_id = '$id'; " );
	$session->message ( "<div class='alert alert-success'><h3>Well Done!</h3>Complaint Assisted Successfully.!</div><embed src='../audio/Windows Print complete.wav' autostart='true' loop='true' width='2' height='0'></embed>" );
	?>
<script type="text/javascript">window.location = "complaint.php?Complaint Assisted Successfully.!";</script>
<?php } ?>
