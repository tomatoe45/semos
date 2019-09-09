<?php
include 'database.php';
include 'mailer.php';
include 'form.php';
class Session {
	var $id; // labeled as user_id
	var $username; // username given on signup
	var $userid; // Random Value generated current logged in
	var $userlevel; // User level
	var $time; // Time user was last active (page loaded)
	var $logged_in; // True if user is logged in. false otherwise
	var $userinfo = array (); // Holding all user info
	var $url; // URL Page current viewed
	var $referrer; // Last recorded site page view
	public $message;

	/* Class Constructor */
	function Session() {
		$this->time = time ();
		$this->startSession ();
		$this->check_message ();
	}

	public function message($msg = "")
	{
		if(!empty($msg))
		{
			$_SESSION['message'] = $msg;
		} else 
		{
			return $this->message;
		}
	}

	private function check_message()
	{
		if(isset($_SESSION['message']))
		{
			$this->message = $_SESSION['message'];
			unset($_SESSION['message']);
		} else
		{
			$this->message = "";
		}
	}

	function startSession() {
		global $database;
		session_start ();

		$this->logged_in = $this->checkLogin ();

		if (! $this->logged_in) {
			$this->username = $_SESSION ['username'] = GUEST_NAME;
			$this->userlevel = GUEST_LEVEL;
			$database->addActiveGuest ( $_SERVER ['REMOTE_ADDR'], $this->time );
		} else {
			$database->addActiveUser ( $this->username, $this->time );
		}

		$database->removeInactiveUsers ();
		$database->removeInactiveGuests ();

		if (isset ( $_SESSION ['url'] )) {
			$this->referrer = $_SESSION ['url'];
		} else {
			$this->referrer = '/';
		}

		$this->url = $_SESSION ['url'] = $_SERVER ['PHP_SELF'];
	}
	function checkLogin() {
		global $database;

		if (isset ( $_COOKIE ['cookname'] ) && isset ( $_COOKIE ['cookid'] )) {
			$this->username = $_SESSION ['username'] = $_COOKIE ['cookname'];
			$this->userid = $_SESSION ['userid'] = $_COOKIE ['cookid'];
		}

		if (isset ( $_SESSION ['username'] ) && isset ( $_SESSION ['userid'] ) && $_SESSION ['username'] != GUEST_NAME) {
			if ($database->confirmUserID ( $_SESSION ['username'], $_SESSION ['userid'] ) != 0) {
				unset ( $_SESSION ['username'] );
				unset ( $_SESSION ['userid'] );
				return false;
			}

			$this->userinfo  = $database->getUserInfo ( $_SESSION ['username'] );
			$this->id        = $this->userinfo ['user_id'];
			$this->username  = $this->userinfo ['username'];
			$this->salt      = $this->userinfo ['salt'];
			$this->userid    = $this->userinfo ['userid'];
			$this->userlevel = $this->userinfo ['userlevel'];
			$this->firstname = $this->userinfo ['firstname'];
			$this->lastname  = $this->userinfo ['lastname'];
			$this->photo     = $this->userinfo ['photo'];
			$this->dept      = $this->userinfo ['dept_name'];
			$this->dept_id   = $this->userinfo ['dept_id'];
			$this->contact   = $this->userinfo ['contact'];
			$this->address   = $this->userinfo ['address'];
			$this->gender    = $this->userinfo ['gender'];
			$this->bday      = $this->userinfo ['bday'];
			$this->email     = $this->userinfo ['email'];
			return true;
		} else {
			return false;
		}
	}
	function login($subuser, $subpass, $subremember) {
		global $database, $form;

		$field = 'user';
		if (! $subuser || strlen ( $subuser = trim ( $subuser ) ) == 0) {
			$form->setError ( $field, '* Username  not Entered' );
		} else {
			if (! preg_match ( "/^([0-9a-z])+$/i", $subuser )) {
				$form->setError ( $field, '* Username not alphanumeric' );
				echo "<embed src='../audio/Windows Logon Sound.wav' autostart='true' loop='true' width='2' height='0'></embed>";
			}
		}

		$field = 'pass';
		if (! $subpass) {
			$form->setError ( $field, '* Password not Entered' );
			echo "<embed src='../audio/Windows Logon Sound.wav' autostart='true' loop='true' width='2' height='0'></embed>";
		}

		if ($form->num_errors > 0) {
			return false;
		}

		$subuser = stripslashes ( $subuser );
		$usersalt = $database->getUserSalt ( $subuser );
		$result = $database->confirmUserPass ( $subuser, $this->hashPassword ( $subpass, $usersalt ) );

		if ($result == 1) {
			$field = 'user';
			$form->setError ( $field, '* Username not found' );
		} else if ($result == 2) {
			$field = 'pass';
			$form->setError ( $field, '* Invalid Password' );
		}

		if ($form->num_errors > 0) {
			return false;
		}

		$this->userinfo = $database->getUserInfo ( $subuser );
		$this->id = $_SESSION ['id'] = $this->userinfo ['id'];
		$this->username = $_SESSION ['username'] = $this->userinfo ['username'];
		$this->userid = $_SESSION ['userid'] = $this->generateRandID ();
		$this->userlevel = $this->userinfo ['userlevel'];

		$database->updateUserField ( $this->username, 'userid', $this->userid );
		$database->addActiveUser ( $this->username, $this->time );
		$database->removeActiveGuest ( $_SERVER ['REMOTE_ADDR'] );

		if ($subremember) {
			setcookie ( 'cookname', $this->username, time () - COOKIE_EXPIRE, COOKIE_PATH );
			setcookie ( 'cookid', $this->userid, time () - COOKIE_EXPIRE, COOKIE_PATH );
		}
		return true;
	}
	function logout() {
		global $database;
		if (isset ( $_COOKIE ['cookname'] ) && isset ( $_COOKIE ['cookid'] )) {
			setcookie ( 'cookname', '', time () - COOKIE_EXPIRE, COOKIE_PATH );
			setcookie ( 'cookid', '', time () - COOKIE_EXPIRE, COOKIE_PATH );
		}

		unset ( $_SESSION ['username'] );
		unset ( $_SESSION ['userid'] );

		$this->logged_in = false;

		$database->removeActiveUser ( $this->username );
		$database->addActiveGuest ( $_SERVER ['REMOTE_ADDR'], $this->time );

		$this->username = GUEST_NAME;
		$this->userlevel = GUEST_LEVEL;
	}
	function register($subuser, $subpass, $subdept, $subfirstname, $sublastname) {
		global $database, $form, $mailer;

		/* Username error checking */
		$field = 'user';
		if (! $subuser || strlen ( $subuser = trim ( $subuser ) ) == 0) {
			$form->setError ( $field, '* Username not Entererd' );
		} else {
			$subuser = stripslashes ( $subuser );
			if (strlen ( $subuser ) < 5) {
				$form->setError ( $field, '* Username below 5 Characters' );
			} else if (strlen ( $subuser ) > 30) {
				$form->setError ( $field, '* Username above 30 Characters' );
			} else if (! preg_match ( "/^([0-9a-z])+$/i", $subuser )) {
				$form->setError ( $field, '* Username not alphanumeric' );
			} else if (strcasecmp ( $subuser, GUEST_NAME ) == 0) {
				$form->setError ( $field, '* Username reserved Word' );
			} else if ($database->usernameTaken ( $subuser )) {
				$form->setError ( $field, '* Username already in use' );
			} else if ($database->usernameBanned ( $subuser )) {
				$form->setError ( $field, '* Username Banned' );
			}
		}

		/* Fields Checking Error */
		$field = 'firstname';
		if (! $subfirstname || strlen ( $subfirstname == trim ( $subfirstname ) ) == 0) {
			$form->setError ( $field, '* Firstname not Entered' );
		} else {
			$subfirstname = strip_tags ( $subfirstname );
			if (strlen ( $subfirstname ) > 30) {
				$form->setError ( $field, '* Firstname too long, 30 Characters max' );
			}
		}

		$field = 'lastname';
		if (! $sublastname || strlen ( $sublastname == trim ( $sublastname ) ) == 0) {
			$form->setError ( $field, '* Lastname not Entered' );
		} else {
			$sublastname = stripslashes ( $sublastname );
			if (strlen ( $sublastname ) > 30) {
				$form->setError ( $field, '* Lastname too long, 30 Characters max' );
			} else if (! preg_match ( "/^([0-9a-z])+$/i", $sublastname )) {
				$form->setError ( $field, '* Lastname not alphanumeric' );
			}
		}

		$field = 'pass';
		if (! $subpass) {
			$form->setError ( $field, '* Password not Entered' );
		} else {
			$subpass = stripslashes ( $subpass );
			if (strlen ( $subpass ) < 4) {
				$form->setError ( $field, '* Password are too short' );
			} else if (! preg_match ( "/^([0-9a-z])+$/i", ($subpass = trim ( $subpass )) )) {
				$form->setError ( $field, '* Password not alphanumeric' );
			}
		}

		$field = 'dept_n';
		if (! $subdept) {
			$form->setError ( $field, '* No department selected' );
		}

		if ($form->num_errors > 0) {
			return 1;
		} else {
			$usersalt = $this->generateUserSalt ();
			if ($database->addNewUser ( $subuser, $this->hashPassword ( $subpass, $usersalt ), $usersalt, $subdept, $subfirstname, $sublastname )) {
				if (EMAIL_WELCOME) {
					$mailer->sendWelcome ( $subuser, $subpass );
				}
				return 0;
			} else {
				return 2;
			}
		}
	}
	function hashPassword($password, $usersalt = NULL) {
		if ($usersalt) {
			$salt = $usersalt;
		} else {
			$salt = $this->salt;
		}

		$hashedpass = hash ( 'sha512', HASH_SALT . $password . $salt );
		for($i = 0; $i < 1000; $i++) {
			$hashedpass = hash ( 'sha512', $hashedpass . HASH_SALT . $password . $salt );
		}
		return $hashedpass;
	}
	function editAccount($subcurpass, $subnewpass, $subemail) {
		global $database, $form;

		if ($subnewpass) {
			$field = 'curpass';
			if (! $subcurpass) {
				$form->setError ( $field, '* Current Password not Entered' );
			} else {
				$subcurpass = stripslashes ( $subcurpass );
				if (strlen ( $subcurpass ) < 4 || ! preg_match ( "/^([0-9a-z])+$/i", ($subcurpass = trim ( $subcurpass )) )) {
					$form->setError ( $field, '* Current Password Incorrect' );
				}
				if ($database->confirmUserPass ( $this->username, $this->hashPassword ( $subcurpass ) ) != 0) {
					$form->setError ( $field, '* Current Password Incorrect' );
				}
			}

			$field = 'newpass';
			$subpass = stripslashes ( $subnewpass );
			if (strlen ( $subnewpass ) < 4) {
				$form->setError ( $field, '* New Password Too Short' );
			} else if (! preg_match ( "/^([0-9a-z])+$/i", ($subnewpass = trim ( $subnewpass )) )) {
				$form->setError ( $field, '* New Password not alphanumeric' );
			}
		} else if ($subcurpass) {
			$field = 'newpass';
			$form->setError ( $field, '* New Password not Entered' );
		}

		$field = 'email';
		if ($subemail && strlen ( $subemail = trim ( $subemail ) ) > 0) {
			$regex = "/^[_+a-z0-9-]+(\.[_+a-z0-9-]+)*" . "@[a-z0-9-]+(\.[a-z0-9-]{1,})*" . "\.([a-z]{2,}){1}$/i";
			if (! preg_match ( $regex, $subemail )) {
				$form->setError ( $field, '* Invalid Email Address' );
			}
			$subemail = stripslashes ( $subemail );
		}

		if ($form->num_errors > 0) {
			return false;
		}

		if ($subcurpass && $subnewpass) {
			$usersalt = $this->generateUserSalt ();
			$database->updateUserField ( $this->username, 'salt', $usersalt );
			$database->updateUserField ( $this->username, 'password', $this->hashPassword ( $subnewpass, $usersalt ) );
		}

		if ($subemail) {
			$database->updateUserField ( $this->username, 'email', $subemail );
		}

		return true;
	}
	function chkUserLevel() {
		return $this->userlevel;
	}
	function isAdmin() {
		return ($this->userlevel == ADMIN_LEVEL || $this->username == ADMIN_NAME);
	}
	function isMaster() {
		return ($this->userlevel == MASTER_LEVEL);
	}
	function isExpert() {
		return ($this->userlevel == EXPERT_LEVEL);
	}
	function isMember() {
		return ($this->userlevel == USER_LEVEL);
	}
	function generateUserSalt() {
		$usersalt = hash ( 'sha512', mt_rand () . HASH_SALT );
		for($i = 0; $i < 10; $i ++) {
			$usersalt = hash ( 'sha512', $usersalt . mt_rand () . HASH_SALT );
		}
		return $usersalt;
	}
	function generateRandID() {
		return md5 ( $this->generateRandStr ( 16 ) );
	}
	function generateRandStr($length) {
		$randstr = "";
		for($i = 0; $i < $length; $i ++) {
			$randnum = mt_rand ( 0, 61 );
			if ($randnum < 10) {
				$randstr .= chr ( $randnum + 48 );
			} else if ($randnum < 36) {
				$randstr .= chr ( $randnum + 55 );
			} else {
				$randstr .= chr ( $randnum + 61 );
			}
		}
		return $randstr;
	}
}

$session = new Session ();
$form = new Form ();
