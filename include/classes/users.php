<?php
class Users extends MyPDO {

	function displayUsers() {
		global $database;
		$q = "SELECT u.*, d.dept_name FROM " . TBL_USERS . " u INNER JOIN " . TBL_DEPT . " d ON u.dept_id = d.dept_id";
		$result = $database->prepare ( $q );
		$result->execute ();
		$dbarray = $result->fetchAll ( PDO::FETCH_ASSOC );
		/* Error occured, return given name by default */
		$num_rows = $result->rowCount ();
		if (! $result || ($num_rows < 0)) {
			echo 'Error displaying info';
			return;
		}
		return $dbarray;
	}

	function getNumMembers() {
		if ($this->num_members < 0) {
			$q = "SELECT * FROM " . TBL_USERS;
			$result = $this->prepare ( $q );
			$result->execute ();
			$this->num_members = $result->rowCount ();
		}
		return $this->num_members;
	}

	function getTechUsers()
	{
		global $database;
		$q = "SELECT * FROM " . TBL_MAIN_USERS;
		$result = $database->prepare($q);
		$result->execute();
		$dbarray = $result->fetchAll(PDO::FETCH_ASSOC);

		$num_rows = $result->rowCount();
		if(!$result || ($num_rows < 0))
		{
			echo 'Error displaying info.';
			return;
		}
		return $dbarray;
	}

function TechUsers() {
global $database;
		$q = "SELECT * FROM " . TBL_USERS . " WHERE userlevel BETWEEN '8' AND '9' ";
		$result = $database->prepare($q);
		$result->execute();
		$dbarray = $result->fetchAll(PDO::FETCH_ASSOC);

		$num_rows = $result->rowCount();
		if(!$result || ($num_rows < 0))
		{
			echo 'Error displaying info.';
			return;
		}

		// if($num_rows == 0) 
		// {
		// 	echo 'No data available in table.';
		// 	return;
		// }

		return $dbarray;
}
	function maintenanceUsers()
	{
		global $database;
		$q = "SELECT * FROM " . TBL_MAIN_USERS;
		$result = $database->prepare($q);
		$result->execute();
		$dbarray = $result->fetchAll(PDO::FETCH_ASSOC);

		$num_rows = $result->rowCount();
		if(!$result || ($num_rows < 0))
		{
			echo 'Error displaying info.';
			return;
		}

		// if($num_rows == 0) 
		// {
		// 	echo 'No data available in table.';
		// 	return;
		// }

		return $dbarray;
	}
	
	function regularUser()
	{
		global $database;
		$q = "SELECT * FROM " . TBL_USERS ;
		$result = $database->prepare($q);
		$result->execute();
		$dbarray = $result->fetchAll(PDO::FETCH_ASSOC);

		$num_rows = $result->rowCount();
		if(!$result || ($num_rows < 0))
		{
			echo 'Error displaying info.';
			return;
		}

		return $dbarray;
	}
}

$users = new Users ();
?>


