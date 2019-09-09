<?php
class Department {
	function getDepartment() {
		global $database;

		$q = "SELECT * FROM " . TBL_DEPT . " ORDER BY dept_id ASC";
		$result = $database->prepare ( $q );
		$result->execute ();

		$dbarray = $result->fetchAll ( PDO::FETCH_ASSOC );

		$num_rows = $result->rowCount ();

		if (! $result || ($num_rows < 0)) {
			echo 'Error displaying info.';
			return;
		}
		return $dbarray;
	}
}

$department = new Department ();