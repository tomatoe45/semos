<div id="view_profile<?= $user['user_id']; ?>" class="modal inmodal fade" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title"><img src="../images/semos.ico" alt="" class="img modal_logo" /> USER PROFILE</h3>
			</div>
			<div class="modal-body">
				<div class="form-body">
					<div class="row">
						<div class="col-md-8 col-sm-12 col-xs-12">
							
							<div class="form-group">
								<label for="" class="control-label"><i class="fa fa-user fa-lg"></i> Name :</label>
								<span><?= ucfirst($user['firstname']); ?> <?= ucfirst($user['lastname']); ?></span>
							</div>

							<div class="form-group">
								<label for="" class="control-label"><i class="fa fa-institution fa-lg"></i> Department :</label>
								<span><?= $user['dept_name']; ?></span>
							</div>
							
							<div class="form-group">
								<label for="" class="control-label"><i class="fa fa-envelope-o fa-lg"></i> Email : </label>
								<span><?= $user['email'] ? $user['email'] : 'Not Specified'; ?></span>
							</div>

							<div class="form-group">
								<label for="" class="control-label"><i class="fa fa-phone fa-lg"></i> Contact No. :</label>
								<span><?= $user['contact'] ? $user['contact'] : 'Not Specified'; ?></span>
							</div>

							<div class="form-group">
								<label for="" class="control-label"><i class="fa fa-home fa-lg"></i> Address :</label>
								<span><?= $user['address'] ? $user['address'] : 'Not Specified'; ?></span>
							</div>
							<div class="form-group">
								<label for="" class="control-label"><i class="fa fa-cubes fa-lg"></i> User Level :</label>
								<span>
								<?= $user['userlevel'] == 9 ? 
				            "Administrator"
				            : ($user['userlevel'] == 8 ? "Technical Support"
				            : ($user['userlevel'] == 7 ? "Expert Level" : "Member")); ?>
            		</span>
							</div>
						</div>
						<div class="col-md-4 col-sm-12 col-xs-12">
							<img src="profile/<?= $user['photo'] ? $user['photo'] : '../../images/user.png' ; ?>" alt="" class="img img-responsive">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>