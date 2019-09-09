<?php 

class Maintenance {

	function getMaintenanceLog() {
		global $database, $session;
		$q = "SELECT * FROM " . TBL_MAINTENANCE . " ORDER BY id ASC";
		$result = $database->prepare($q);
		$result->execute();
		$dbarray = $result->fetchAll(PDO::FETCH_ASSOC);
		/*Error Occured*/
		$num_rows = $result->rowCount();
		if(!$result || ($num_rows < 0)) {
			echo 'Error displaying info';
			return;
		}
    return $dbarray;
	}

}
?>