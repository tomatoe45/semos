<?php include 'components/header.php'; ?>

<body class="login">
	<div class="">
		<a href="" id="signup" class="hiddenanchor"></a> <a href=""
			id="signin" class="hiddenanchor"></a>

		<div class="login_wrapper">

			<?php if($session->logged_in) { ?>
			<h3>REGISTERED</h3>
			<p>
				We're sorry <strong><?= $session->username; ?></strong>, but you've
				already registered. Click <a href="index.php">here</a> to Login.
			</p>
			<?php
			} else if (isset ( $_SESSION ['regsuccess'] )) {
				if ($_SESSION ['regsuccess']) {
					?>
			<div class="animate form">
				<section class="login_content">
					<h1>REGISTRATION</h1>
					<div class="form-group">
						<p class="change_link">Registered Successfully!</p>
					</div>
					<div class="form-group">
						<p>
							Thank you! <strong><?= strtoupper($_SESSION['reguname']); ?></strong>,<br>
							 Your	Information has been added to the database. <br><br><br>
							 You may now <a href="index.php">Login</a>.
						</p>
					</div>
				</section>
			</div>
				<?php } else { ?>
			<div class="animate form">
				<section class="login_content">
					<h1>REGISTRATION</h1>
					<div class="form-group">
						<p class="change_link">Registered Failed</p>
					</div>
					<div class="form-group">
						<p>
							We're sorry, But an error has been occured and your registration
							for username<strong><?= $_SESSION['reguname']; ?></strong>, Could
							not be completed<br> <strong>Please try again later.</strong>.
						</p>
					</div>
				</section>
			</div>
				<?php
				}
				unset ( $_SESSION ['regsuccess'] );
				unset ( $_SESSION ['reguname'] );
			} else {
				?>
			<div id="signup" class="animate form">
				<section class="login_content">
					<form action="include/process.php" class="form-horizontal"
						method="post">
						<h1>REGISTRATION</h1>
						<div class="form-group">
							<?= $form->error('firstname'); ?>
							<input type="text" name="firstname" class="form-control"
								placeholder="Firstname" value="<?= $form->value('firstname')?>"
								required="required" />
						</div>

						<div class="form-group">
							<?= $form->error('lastname'); ?>
							<input type="text" name="lastname" class="form-control"
								placeholder="Lastname" value="<?= $form->value('lastname')?>"
								required="required" />
						</div>

						<div class="form-group">
							<?= $form->error('dept');?>
							<select name="dept_n" class="form-control" required="required">
								<option value="<?= $form->value('dept');?>" disabled="disabled"
									selected="selected">PLEASE SELECT DEPARTMENT</option>
								<?php foreach ($depts as $dept) : ?>
								<option value="<?= $dept['dept_id']; ?>"><?= strtoupper($dept['dept_name']); ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<br />
						<div class="form-group">
							<?= $form->error('user'); ?>
							<input type="text" name="user" class="form-control"	placeholder="Username" value="<?= $form->value('user');?>" required="required" />
						</div>

						<div class="form-group">
							<?= $form->error('pass'); ?>
							<input type="password" name="pass" class="form-control"	placeholder="Password" value="<?= $form->value('pass'); ?>" required="required" />
						</div>

						<div class="form-group">
							<input type="hidden" name="subjoin" class="form-control" value="1" />
							<button type="submit" name="signup" class="btn btn-default">
								<i class="fa fa-arrow-circle-o-right"></i> SIGNUP
							</button>
						</div>

						<div class="separator"></div>

						<p class="change_link">
							ALREADY A MEMBER ? <a href="index.php" class="to_register">LOGIN</a>
						</p>
						<div class="">
							<?php include 'components/footer.php'; ?>
						</div>
					</form>
				</section>
			</div>
			<?php } ?>

		</div>

	</div>
</body>