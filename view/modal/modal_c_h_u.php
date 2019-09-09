<div class="modal inmodal fade"
	id="assisted_claimed<?= $lc['comp_id']; ?>" role="modal"
	data-background="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<form action="" method="post" class="form-horizontal">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">&times;</button>
					<h4 class="modal-title">
                        <img src="../images/semos.ico" alt="" class="img modal_logo" /> RE-ASSIGNED COMPLAINT
					</h4>
				</div>
				<div class="modal-body">
					<div class="form-body">
						<div class="form-group">
							<label for="" class="control-label">Subject :</label> <input
								type="text" class="form-control" value="<?= $lc['subject'];  ?>"
								readonly="readonly">
						</div>
						<div class="form-group">
							<input type="hidden" name="c_id" class="form-control"
								value="<?= $lc['comp_id']; ?>">
              <?php

														if ($lc ['cat_comp_id'] == '3') {
															echo "<label for='' class='control-label'>Maintenance Supprt :</label>";
														} else {
															echo "<label for='' class='control-label'>Technical Supprt :</label>";
														}
														?>
              <?php if($lc['cat_comp_id'] == '3') { ?>
            <select name="tech_s" class="form-control"
								required="required">
								<option value="<?= $lc['assisted']; ?>" selected="selected"><?= strtoupper($lc['assisted']); ?></option>
								<option value="" disabled="disabled">MAINTENANCE SUPPORT</option>
              <?php foreach ($mnt_users  as $gt): ?>
                <option
									value="<?= $gt['firstname'] . ' ' . $gt['lastname']; ?>"><?= strtoupper($gt['firstname'] . ' ' . $gt['lastname']); ?></option>
              <?php endforeach ?>
            </select>
            <?php } else { ?>
            <select name="tech_s" class="form-control"
								required="required">
								<option value="<?= $lc['assisted']; ?>" selected="selected"><?= strtoupper($lc['assisted']); ?></option>
								<option value="" disabled="disabled">SELECT TECH SUPPORT</option>
              <?php foreach ($t_users as $tu): ?>
                <option
									value="<?= $tu['firstname'] . ' ' . $tu['lastname']; ?>"><?= strtoupper($tu['firstname'] . ' ' . $tu['lastname']); ?></option>
              <?php endforeach ?>
            </select>
            <?php } ?>
          </div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" name="c_update" class="btn btn-primary">Save
						changes</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</form>
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php
global $database;
if (isset ( $_POST ['c_update'] )) {
	$id = $_POST ['c_id'];
	$ts = $_POST ['tech_s'];

	$database->exec ( "UPDATE " . TBL_COMPLAINT . " SET assisted = '$ts' WHERE comp_id = '$id' " );
	$session->message ( "<div class='alert alert-success'><h3>Well Done!</h3>Complaint Successfully RE-assigned.</div><embed src='../audio/Windows Print complete.wav' autostart='true' loop='true' width='2' height='0'></embed>" );
	?>
<script type="text/javascript">window.location = "complaint_history.php?Complaint Successfully RE-assigned.!"; </script>
<?php } ?>