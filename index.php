<?php include 'components/header.php'; ?>
<body class="login">

	<div>
		<a class="hiddenanchor" id="signup"></a> <a class="hiddenanchor"
			id="signin"></a>

		<div class="login_wrapper">

			<div class="animate form login_form">

				<section class="login_content">

					<form action="include/process.php" class="form-horizontal"
						method="post">

						<h1>SEMOS</h1>

						<div>
							<div><?= $form->error('user'); ?></div>
							<input type="text" class="form-control" placeholder="Username"
								name="user" value="<?= $form->value('user'); ?>"
								required="required" />
						</div>

						<div>
							<div><?= $form->error('pass'); ?></div>
							<input type="password" class="form-control"
								placeholder="Password" name="pass"
								value="<?= $form->value('pass'); ?>" required="required" />
						</div>

						<div class="pull-left">
							<input type="hidden" class="form-control" name="sublogin"
								value="1" />
							<button type="submit" name="login" class="btn btn-default">
								<i class="fa fa-arrow-circle-o-right"></i> Log In
							</button>

							<div class="checkbox pull-right">
								<label for=""> <input type="checkbox" class="flat"
									name="remember" />
									<?php if($form->value('remember') != '') { echo 'checked';} ?>
									REMEMBER ME
								</label>
							</div>
						</div>

						<div class="clearfix"></div>

						<div class="separator">
							<p class="change_link">
								NEW TO SYSTEM ? REGISTER<a href="register.php"
									data-toggle="tooltip" data-placement="top"
									data-original-title="Click to Register" class="to_register">
									HERE.</a>
							</p>
							<div class="clearfix"></div>

							<div><?php include('components/footer.php'); ?></div>

						</div>

					</form>

				</section>

			</div>

		</div>

	</div>
	<embed src='audio/Windows Logon Sound.wav' autostart='false' loop='false'  width='2' height='0'></embed>
	<script type="text/javascript" src="assets/iCheck/icheck.min.js"></script>
	<?php 

		if($form->error('pass')) {
			echo "<embed src='audio/Windows Critical Stop.wav' autostart='false' loop='false'  width='2' height='0'></embed>";
		}

	?>
</body>
</html>