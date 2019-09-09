<?php 
/*Complaint Type*/
  
  /*Specific Type*/

  /*Concern Type*/


  function getCompType() {
    global $database;
      $q = "SELECT * FROM " . TBL_SETUP . " WHERE specid = 1 ";
      $result = $database->prepare($q);
      $result->execute();
      $dbarray = $result->fetchAll(PDO::FETCH_ASSOC);
      /*Error occured, return given name by default*/
      $num_rows = $result->rowCount();
      if(!$result || ($num_rows < 0)) {
        echo 'Error displaying info';
        return;
      }
      if($num_rows == 0) {
        echo 'No data available in table';
        return;
      }
      foreach ($dbarray as $cmpt) {
      ?>
      <option value="<?= $cmpt['description']; ?>"><?= $cmpt['description']; ?></option>
      <?php
      }
    }

      function getCompSpec() {
        global $database;
      $q = "SELECT * FROM " . TBL_SETUP . " WHERE specid = 2 ";
      $result = $database->prepare($q);
      $result->execute();
      $dbarray = $result->fetchAll(PDO::FETCH_ASSOC);
      /*Error occured, return given name by default*/
      $num_rows = $result->rowCount();
      if(!$result || ($num_rows < 0)) {
        echo 'Error displaying info';
        return;
      }
      if($num_rows == 0) {
        echo 'No data available in table';
        return;
      }
      foreach ($dbarray as $cspc) {
        ?>
        <option value="<?= $cspc['description']; ?>"><?= $cspc['description']; ?></option>
        <?php
      }
  }

  function getCompConcern() {
      global $database;
      $q = "SELECT * FROM " . TBL_SETUP . " WHERE specid = 3 ";
      $result = $database->prepare($q);
      $result->execute();
      $dbarray = $result->fetchAll(PDO::FETCH_ASSOC);
      /*Error occured, return given name by default*/
      $num_rows = $result->rowCount();
      if(!$result || ($num_rows < 0)) {
        echo 'Error displaying info';
        return;
      }
      if($num_rows == 0) {
        echo 'No data available in table';
        return;
      }
      foreach ($dbarray as $con) {
      ?>
        <option value="<?= $con['description']; ?>"><?= $con['description']; ?></option>
      <?php
      }
  }
  
  class Setups {
  	
  	function getDept() {
  		global $database;
  		
  		$q = "SELECT * FROM " . TBL_DEPARTMENT;
  		$result = $database->prepare($q);
  		$result->execute();
  		$dbarray = $result->fetchAll(PDO::FETCH_ASSOC);
  		
  		$num_rows = $result->rowCount();
  		if(!$result || ($num_rows < 0) ) {
  			echo 'Error displaying info.';
  			return;
  		}
  		if($num_rows == 0) {
  			echo 'No data available to be displayed';
  			return;
  		}
  			return $dbarray;
  	}
  	
  	function getConcern() {
  		global $database;
  		$q = "SELECT * FROM " . TBL_SETUP . " WHERE specid = 3 ";
  		$result = $database->prepare($q);
  		$result->execute();
  		$dbarray = $result->fetchAll(PDO::FETCH_ASSOC);
  		/*Error occured, return given name by default*/
  		$num_rows = $result->rowCount();
  		if(!$result || ($num_rows < 0)) {
  			echo 'Error displaying info';
  			return;
  		}
  		if($num_rows == 0) {
  			echo 'No data available in table';
  			return;
  		}
  		
  			return $dbarray;
  	  }
  	
  	  function getSpecific() {
  	  	global $database;
  	  	$q = "SELECT * FROM " . TBL_SETUP . " WHERE specid = 2 ";
  	  	$result = $database->prepare($q);
  	  	$result->execute();
  	  	$dbarray = $result->fetchAll(PDO::FETCH_ASSOC);
  	  	/*Error occured, return given name by default*/
  	  	$num_rows = $result->rowCount();
  	  	if(!$result || ($num_rows < 0)) {
  	  		echo 'Error displaying info';
  	  		return;
  	  	}
  	  	if($num_rows == 0) {
  	  		echo 'No data available in table';
  	  		return;
  	  	}
	  	 	return $dbarray;
  	    }
  	
  	    function getComplaint() {
  	    	global $database;
  	    	$q = "SELECT * FROM " . TBL_SETUP . " WHERE specid = 1 ";
  	    	$result = $database->prepare($q);
  	    	$result->execute();
  	    	$dbarray = $result->fetchAll(PDO::FETCH_ASSOC);
  	    	/*Error occured, return given name by default*/
  	    	$num_rows = $result->rowCount();
  	    	if(!$result || ($num_rows < 0)) {
  	    		echo 'Error displaying info';
  	    		return;
  	    	}
  	    	if($num_rows == 0) {
  	    		echo 'No data available in table';
  	    		return;
  	    	}
	  	  	return $dbarray;
  	      }
  }
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  

?>