<?php
class Settings extends MyPDO {
	function getCategory() {
		global $database;
		$q = "SELECT * FROM " . TBL_CATEGORY;
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

	function getComplaintCategory()
	{
		global $database;
		$q = "SELECT * FROM " . TBL_COMP;
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

	function getComplaintSpecific()
	{
		global $database;
		$q = "SELECT c.*, s.* FROM " . TBL_SPEC . " s INNER JOIN ".TBL_COMP." c ON c.cat_comp_id = s.cat_comp_id ORDER BY s.cat_spec_id ASC ";
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

	function getComplaintConcern()
	{
		global $database;
		$q = "SELECT c.*, s.*, n.* FROM " . TBL_CONC . " n
					INNER JOIN " . TBL_COMP . " c ON c.cat_comp_id = n.cat_comp_id
					INNER JOIN " . TBL_SPEC . " s ON s.cat_spec_id = n.cat_spec_id
					ORDER BY n.cat_con_id ASC";
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