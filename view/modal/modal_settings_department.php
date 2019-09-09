<div id="new_department" class="modal inmodal fade" role="dialog"
	aria-hidden="true" tabindex="-1">
	<div class="modal-dialog">

		<form action="" method="post" class="form-horizontal">
			<div class="modal-content">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3 class="modal-title"><img src="../images/semos.ico" alt="" class="img modal_logo" /> NEW DEPARTMENT</h3>
				</div>

				<div class="modal-body">
					<div class="form-body">
						<div class="form-group">
							<label for="" class="control-label">DEPARTMENT NAME</label> <input
								type="text" class="form-control" name="dept_name"
								placeholder="New Department Name" required="required"
								autofocus="autofocus" />
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="submit" name="save_dept"
						class="btn btn-success btn-outline">
						<i class="fa fa-save"></i> Save
					</button>
				</div>
			</div>
		</form>

	</div>
</div>
<?php
global $database, $session;

if (isset ( $_POST ['save_dept'] )) {
	$dept_n = $_POST ['dept_name'];

	$database->exec ( "INSERT INTO " . TBL_DEPT . " (dept_name) VALUES ('$dept_n')" );
	$session->message ( "<div class='alert alert-success'><h3>Well Done.!</h3>New Department added Successfully.</div><embed src='../audio/Windows Print complete.wav' autostart='true' loop='true' width='2' height='0'></embed>" );
	?>
<script>window.location = "settings.php?Added Successfully"</script>
<?php
}
?>