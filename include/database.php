<?php
include 'constants.php';
class MyPDO extends PDO {
	var $num_active_users;
	var $num_active_guests;
	var $num_members;
	var $num_solved;
	var $num_pending;
	var $num_complaint;
	var $num_c_bio;
	var $num_c_it;
	var $num_c_mn;
	var $num_c_bio_pending;
	var $num_c_it_pending;
	var $num_c_mn_pending;
	var $num_c_bio_solved;
	var $num_c_it_solved;
	var $num_c_mn_solved;
	var $num_c_c_solved;		
	var $num_total_complaint;


	public function __construct() {
		$dsn = DB_DRIVER . ':host=' . DB_SERVER . ';dbname=' . DB_NAME;

		parent::__construct ( $dsn, DB_USER, DB_PASS );

		$this->num_members       = - 1;
		$this->num_solved        = - 1;
		$this->num_pending       = - 1;
		$this->num_complaint     = - 1;
		$this->num_c_bio         = -1;
		$this->num_c_it          = -1;
		$this->num_c_mn          = -1;
		$this->num_c_bio_pending = -1;
		$this->num_c_it_pending  = -1;
		$this->num_c_mn_pending  = -1;
		$this->num_c_bio_solved  = -1;
		$this->num_c_it_solved   = -1;
		$this->num_c_mn_solved   = -1;
		$this->num_c_c_solved = -1;
		$this->num_total_complaint = -1;


		if (TRACK_VISITORS) {
			$this->calcNumActiveUsers ();
			$this->calcNumActiveGuests ();
		}
	}
	function confirmUserID($username, $userid) {
		if (! get_magic_quotes_gpc ()) {
			$username = addslashes ( $username );
		}

		$q = "SELECT userid FROM " . TBL_USERS . " WHERE username = ?";
		$result = $this->prepare ( $q );
		$result->execute ( array (
				$username
		) );
		if (! $result) {
			return 1;
		}

		$dbarray = $result->fetch ( PDO::FETCH_ASSOC );
		$dbarray ['userid'] = stripslashes ( $dbarray ['userid'] );
		$userid = stripslashes ( $userid );

		if ($userid == $dbarray ['userid']) {
			return 0;
		} else {
			return 2;
		}
	}
	function confirmUserPass($username, $password) {
		if (! get_magic_quotes_gpc ()) {
			$username = addslashes ( $username );
		}

		$q = "SELECT password FROM " . TBL_USERS . " WHERE username = ?";
		$result = $this->prepare ( $q );
		$result->execute ( array (
				$username
		) );

		if (! $result) {
			return 1;
		}

		$dbarray = $result->fetch ( PDO::FETCH_ASSOC );
		$dbarray ['password'] = stripslashes ( $dbarray ['password'] );
		$password = stripslashes ( $password );

		if ($password == $dbarray ['password']) {
			return 0;
		} else {
			return 2;
		}
	}
	function getUserSalt($username) {
		if (! get_magic_quotes_gpc ()) {
			$username = addslashes ( $username );
		}

		$q = "SELECT salt FROM " . TBL_USERS . " WHERE username = ?";
		$result = $this->prepare ( $q );
		$result->execute ( array (
				$username
		) );

		if (! $result) {
			return 1;
		}

		$dbarray = $result->fetch ( PDO::FETCH_ASSOC );
		$dbarray ['salt'] = stripslashes ( $dbarray ['salt'] );
		return $dbarray ['salt'];
	}
	function usernameTaken($username) {
		if (! get_magic_quotes_gpc ()) {
			$username = addslashes ( $username );
		}

		$q = "SELECT COUNT(*) FROM " . TBL_USERS . " WHERE username = ?";
		$result = $this->prepare ( $q );
		$result->execute ( array (
				$username
		) );

		if ($result->fetchColumn () > 0) {
			return true;
		} else {
			return false;
		}
	}
	function usernameBanned($username) {
		if (! get_magic_quotes_gpc ()) {
			$username = addslashes ( $username );
		}

		$q = "SELECT username FROM " . TBL_BANNED_USERS . " WHERE username = ?";
		$result = $this->prepare ( $q );
		$result->execute ( array (
				$username
		) );

		if ($result->fetchColumn () > 0) {
			return true;
		} else {
			return false;
		}
	}
	function getUserInfo($username) {
		$q = "SELECT u.*, d.* FROM ". TBL_USERS." u LEFT JOIN ". TBL_DEPT ." d ON u.dept_id = d.dept_id WHERE username = ?";
		$result = $this->prepare ( $q );
		$result->execute ( array (
				$username
		) );

		if (! $result) {
			return null;
		}

		$dbarray = $result->fetch ( PDO::FETCH_ASSOC );
		return $dbarray;
	}
	function getUserProfile($id) {
		$q = "SELECT * FROM " . TBL_USERS . " WHERE user_id = '$id'";
		$result = $this->prepare ( $q );
		$result->execute ( array (
				$id
		) );

		if (! result) {
			return null;

			$dbarray = $result->fetch ( PDO::FETCH_ASSOC );
			return $dbarray;
		}
	}
	function addNewUser($username, $password, $usersalt, $dept, $firstname, $lastname) {
		$time = time ();
		if (strcasecmp ( $username, ADMIN_NAME ) == 0) {
			$ulevel = ADMIN_LEVEL;
		} else {
			$ulevel = USER_LEVEL;
		}

		$q = "INSERT INTO " . TBL_USERS . "(username, password, salt, userlevel, dept_id, timestamp, firstname, lastname) VALUES(?,?,?,?,?,?,?,?)";
		$result = $this->prepare ( $q );
		$result->execute ( array (
				$username,
				$password,
				$usersalt,
				$ulevel,
				$dept,
				$time,
				$firstname,
				$lastname
		) );
		return $result;
	}
	function updateUserField($username, $field, $value) {
		$q = "UPDATE " . TBL_USERS . " SET $field = ? WHERE username = ?";
		$result = $this->prepare ( $q );
		$result->execute ( array (
				$value,
				$username
		) );
		return $result;
	}
	function addActiveUser($username, $time) {
		$q = "UPDATE " . TBL_USERS . " SET timestamp = ? WHERE username = ?";
		$result = $this->prepare ( $q );
		$result->execute ( array (
				$time,
				$username
		) );

		if (! TRACK_VISITORS)
			return;

		$q = "REPLACE INTO " . TBL_ACTIVE_USERS . " VALUES(?, ?)";
		$result = $this->prepare ( $q );
		$result->execute ( array (
				$username,
				$time
		) );
		$this->calcNumActiveUsers ();
	}
	function addActiveGuest($ip, $time) {
		if (! TRACK_VISITORS)
			return;

		$q = "REPLACE INTO " . TBL_ACTIVE_GUESTS . " VALUES(?, ?)";
		$result = $this->prepare ( $q );
		$result->execute ( array (
				$ip,
				$time
		) );
		$this->calcNumActiveGuests ();
	}
	function removeActiveUser($username) {
		if (! TRACK_VISITORS)
			return;
		$q = "DELETE FROM " . TBL_ACTIVE_USERS . " WHERE username = ?";
		$result = $this->prepare ( $q );
		$result->execute ( array (
				$username
		) );
		$this->calcNumActiveUsers ();
	}
	function removeActiveGuest($ip) {
		if (! TRACK_VISITORS)
			return;

		$q = "DELETE FROM " . TBL_ACTIVE_GUESTS . " WHERE ip = ?";
		$result = $this->prepare ( $q );
		$result->execute ( array (
				$ip
		) );
		$this->calcNumActiveGuests ();
	}
	function removeInactiveUsers() {
		if (! TRACK_VISITORS)
			return;
		$timeout = time () - USER_TIMEOUT * 60;
		$q = "DELETE FROM " . TBL_ACTIVE_USERS . " WHERE timestamp < ?";
		$result = $this->prepare ( $q );
		$result->execute ( array (
				$timeout
		) );
		$this->calcNumActiveUsers ();
	}
	function removeInactiveGuests() {
		if (! TRACK_VISITORS)
			return;
		$timeout = time () - USER_TIMEOUT * 60;
		$q = "DELETE FROM " . TBL_ACTIVE_GUESTS . " WHERE timestamp < ?";
		$result = $this->prepare ( $q );
		$result->execute ( array (
				$timeout
		) );
		$this->calcNumActiveGuests ();
	}
	function calcNumActiveUsers() {
		$q = "SELECT * FROM " . TBL_ACTIVE_USERS;
		$result = $this->prepare ( $q );
		$result->execute ();
		$this->num_active_users = $result->rowCount ();
	}
	function calcNumActiveGuests() {
		$q = "SELECT * FROM " . TBL_ACTIVE_GUESTS;
		$result = $this->prepare ( $q );
		$result->execute ();
		$this->num_active_guests = $result->rowCount ();
	}
}

try {
	$database = new MyPDO ();
} catch ( PDOException $e ) {
	header ( 'Location: error/503.php' );
	exit ();
}
