<?php
include ('session.php');
class Process {
	var $pattern = "/^([0-9a-z])+$/i";

	/* Class Constructor */
	function Process() {
		global $session;
		if (isset ( $_POST ['sublogin'] )) /* User submitted login form */
		{
			$this->procLogin ();
		} else if (isset ( $_POST ['subjoin'] )) /* User submitted registration form */
		{
			$this->procRegister ();
		} else if (isset ( $_POST ['subforgot'] )) /* User submitted forgot password form */
		{
			$this->procForgotPass ();
		} else if (isset ( $_POST ['subedit'] )) /* User submitted edit accounut form */
		{
			$this->procEditAccount ();
		} else if ($session->logged_in) {
			$this->procLogout ();
		} else {
			header ( 'Location: ../index.php' );
		}
	}
	function procLogin() {
		global $session, $form;
		$retval = $session->login ( $_POST ['user'], $_POST ['pass'], isset ( $_POST ['remember'] ) );

		if ($retval == true) {
			header ( "Location: ../view/dashboard.php" );
			echo "<script>alert('OK')</script>";
		} else {
			$_SESSION ['value_array'] = $_POST;
			$_SESSION ['error_array'] = $form->getErrorArray ();
			header ( "Location: " . $session->referrer );
		}
	}
	function procRegister() {
		global $session, $form;

		if (ALL_LOWERCASE) /* Convert username to all lowercase (by option) */
		{
			$_POST ['user'] = strtolower ( $_POST ['user'] );
		}

		$retval = $session->register ( $_POST ['user'], $_POST ['pass'], $_POST ['dept_n'], $_POST ['firstname'], $_POST ['lastname'] );

		if ($retval == 0) {
			$_SESSION ['reguname'] = $_POST ['user'];
			$_SESSION ['regsuccess'] = true;
			header ( "Location: " . $session->referrer );
		} else if ($retval == 1) {
			$_SESSION ['value_array'] = $_POST;
			$_SESSION ['error_array'] = $form->getErrorArray ();
			header ( "Location: " . $session->referrer );
		} else if ($retval == 2) {
			$_SESSION ['reguname'] = $_POST;
			$_SESSION ['regsuccess'] = false;
			header ( "Location: " . $session->referrer );
		}
	}
	function procForgotPass() {
		global $database, $session, $mailer, $form;

		$subuser = $_POST ['user'];
		$field = 'user';
		if (! $subuser || strlen ( $subuser = trim ( $subuser ) ) == 0) {
			$form->setError ( $field, "* Username not Entered." );
		} else {
			$subuser = stripslashes ( $subuser );
			if (strlen ( $subuser ) < 5 || strlen ( $subuser ) > 30 || ! preg_match ( $pattern, $subuser ) || (! $database->usernameTaken ( $subuser ))) {
				$form->setError ( $field, "* Username does not exists." );
			}
		}

		if ($form->num_errors > 0) {
			$_SESSION ['value_array'] = $_POST;
			$_SESSION ['error_array'] = $form->getErrorArray ();
		} else {
			$newpass = $session->generateRandStr ( 8 );

			$usrinf = $database->getUserInfo ( ($subuser) );
			$email = $usrinf ['email'];

			if ($mailer->sendNewPass ( $subuser, $email, $newpass )) {
				$newusersalt = $session->generateUserSalt ();
				$database->updateUserField ( $subuser, 'salt', $newusersalt );
				$database->updateUserField ( $subuser, 'password', $session->hashPassword ( $newpass, $newusersalt ) );
				$_SESSION ['forgotpass'] = true;
			} else {
				$_SESSION ['forgotpass'] = false;
			}
		}
		header ( 'Location: ' . $session->referrer );
	}
	function procEditAccount() {
		global $session, $form;

		$retval = $session->editAccount ( $_POST ['curpass'], $_POST ['newpass'], $_POST ['email'] );

		if ($retval) {
			$_SESSION ['useredit'] = true;
			header ( 'Location: ' . $session->referrer );
			$session->message ( "<div class='alert alert-success'><h3>Well Done!</h3>Password Successfully Updated.</div>" );
		} else {
			$_SESSION ['value_array'] = $_POST;
			$_SESSION ['error_array'] = $form->getErrorArray ();
			header ( 'Location: ' . $session->referrer );
		}
	}
	function procLogout() {
		global $session;
		$retval = $session->logout ();
		header ( "Location: ../index.php" );
	}
}

$process = new Process ();

