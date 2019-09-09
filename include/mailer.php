<?php
class Mailer {
	function sendWelcome($user, $email, $pass) {
		$form = "Form : " . EMAIL_FROM_NAME . " <" . EMAIL_FROM_ADDR . ">";
		$subject = "Welcome";
		$body = $user . ",\n\n Welcome!" . "Username :" . $user . "\n" . "Password :" . $pass . "\n";

		return mail ( $email, $subject, $body, $form );
	}
	function sendNewPass($user, $email, $pass) {
		$form = "Form : " . EMAIL_FROM_NAME . " <" . EMAIL_FROM_ADDR . ">";
		$subject = "Welcome";
		$body = $user . "\n\n" . "Username : " . $user . "\n\n New Password : " . $pass . "\n";

		return mail ( $email, $subject, $body, $form );
	}
}

$mailer = new Mailer ();
