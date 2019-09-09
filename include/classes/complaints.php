<?php
/*
+----+------+
|  0 | REQUEST COMPLAINT 
|  1 | ASSISTED COMPLAINT 
|  2 | SAVE COMPLAINT (MONITOR PART)
|  3 |
|  4 |
|  5 | COMPLETE COMPLAINT
+----+------+
|    |
|    |
|    |
+----+------+
 */

class Complaints extends MyPDO {

  function getTotalComplaint()
  {
    if ($this->num_total_complaint < 0) {
      $q = "SELECT * FROM " . TBL_COMPLAINT;
      $result = $this->prepare ( $q );
      $result->execute ();
      $this->num_total_complaint = $result->rowCount ();
    }
    return $this->num_total_complaint;
  }

	function getNumComplaint() {
		if ($this->num_complaint < 0) {
			$q = "SELECT * FROM " . TBL_COMPLAINT . " WHERE status = '0'";
			$result = $this->prepare ( $q );
			$result->execute ();
			$this->num_complaint = $result->rowCount ();
		}
		return $this->num_complaint;
	}

	function getSolveComplaint() {
		if ($this->num_solved < 0) {
			$q = "SELECT * FROM " . TBL_COMPLAINT . " WHERE status = '5' ";
			$result = $this->prepare ( $q );
			$result->execute ();
			$this->num_solved = $result->rowCount ();
		}
		return $this->num_solved;
	}

	function getPendingComplaint() {
		if ($this->num_pending < 0) {
			$q = "SELECT * FROM " . TBL_COMPLAINT . " WHERE status BETWEEN '0' AND '2' ";
			$result = $this->prepare ( $q );
			$result->execute ();
			$this->num_pending = $result->rowCount ();
		}
		return $this->num_pending;
	}

  /*Get Complaint Record By Complaint Category - Total*/
  function getComplaintTotalBiomed()
  {
  if ($this->num_c_bio < 0) {
      $q = "SELECT * FROM " . TBL_COMPLAINT . " WHERE cat_comp_id = '1' ";
      $result = $this->prepare ( $q );
      $result->execute ();
      $this->num_c_bio = $result->rowCount ();
    }
    return $this->num_c_bio;
  }

  function getComplaintTotalIT()
  {
    if ($this->num_c_it < 0) {
      $q = "SELECT * FROM " . TBL_COMPLAINT . " WHERE cat_comp_id = '2' ";
      $result = $this->prepare ( $q );
      $result->execute ();
      $this->num_c_it = $result->rowCount ();
    }
    return $this->num_c_it;
  }

  function getComplaintTotalMT()
  {
  if ($this->num_c_mn < 0) {
      $q = "SELECT * FROM " . TBL_COMPLAINT . " WHERE cat_comp_id = '3' ";
      $result = $this->prepare ( $q );
      $result->execute ();
      $this->num_c_mn = $result->rowCount ();
    }
    return $this->num_c_mn;
  }
  /* End Get Complaint Record By Complaint Category - Total*/
  /* Get Complaint Record By Complaint Category - Pending */
  function getComplaintTotalBIOPENDING() 
  {
    if ($this->num_c_bio_pending < 0) {
      $q = "SELECT * FROM " . TBL_COMPLAINT . " WHERE cat_comp_id = '1' AND status BETWEEN '0' AND '2' ";
      $result = $this->prepare ( $q );
      $result->execute ();
      $this->num_c_bio_pending = $result->rowCount ();
    }
    return $this->num_c_bio_pending;
  }
  function getComplaintTotalITPENDING() 
  {
    if($this->num_c_it_pending < 0)
    {
      $q = "SELECT * FROM " . TBL_COMPLAINT . " WHERE cat_comp_id = '2' AND status BETWEEN '0' AND '2' ";
      $result = $this->prepare($q);
      $result->execute();
      $this->num_c_it_pending = $result->rowCount();
    }
    return $this->num_c_it_pending;
  }
  function getComplaintTotalMNPENDING()
  {
    if($this->num_c_mn_pending < 0)
    {
      $q = "SELECT * FROM " . TBL_COMPLAINT . " WHERE cat_comp_id = '3' AND status BETWEEN '0' AND '2' ";
      $result = $this->prepare($q);
      $result->execute();
      $this->num_c_mn_pending = $result->rowCount();
    }
    return $this->num_c_mn_pending;
  }
  /* End Get Complaint Record By Complaint Category - Pending */
  /* Get Complaint Record By Complaint Category - Solved*/
  function getComplaintTotalBIOSOLVED()
  {
    if ($this->num_c_bio_solved < 0) {
      $q = "SELECT * FROM " . TBL_COMPLAINT . " WHERE cat_comp_id = '1' AND status = '5' ";
      $result = $this->prepare ( $q );
      $result->execute ();
      $this->num_c_bio_solved = $result->rowCount ();
    }
    return $this->num_c_bio_solved;
  }
  function getComplaintTotalITSOLVED()
  {
    if($this->num_c_it_solved < 0)
    {
      $q = "SELECT * FROM " . TBL_COMPLAINT . " WHERE cat_comp_id = '2' AND status = '5' ";
      $result = $this->prepare($q);
      $result->execute();
      $this->num_c_it_solved = $result->rowCount();
    }
    return $this->num_c_it_solved;
  }
  function getComplaintTotalMNSOLVED()
  {
    if($this->num_c_mn_solved < 0)
    {
      $q = "SELECT * FROM " . TBL_COMPLAINT . " WHERE cat_comp_id = '3' AND status = '5' ";
      $result = $this->prepare($q);
      $result->execute();
      $this->num_c_mn_solved = $result->rowCount();
    }
    return $this->num_c_mn_solved;
  }
  /* END Get Complaint Record By Complaint Category - Solved*/

  function getComplaintList(){
    global $database, $session;
      $q = "SELECT c.*, d.*, u.*, ct.*, st.*, cc.*  FROM ".TBL_COMPLAINT." c 
      INNER JOIN " . TBL_DEPT . " d ON c.dept_id      = d.dept_id
      INNER JOIN " . TBL_USERS. " u ON c.user_id      = u.user_id
      INNER JOIN " . TBL_COMP . " ct ON c.cat_comp_id = ct.cat_comp_id
      INNER JOIN " . TBL_SPEC . " st ON c.cat_spec_id = st.cat_spec_id
      INNER JOIN " . TBL_CONC . " cc ON c.cat_con_id  = cc.cat_con_id
      WHERE c.status = '0' ORDER BY c.comp_id DESC LIMIT 5 " ;
      
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

  function getComplaintAssisted(){
    global $database, $session;
    $q = "SELECT c.*, d.*, u.*, cc.* FROM ".TBL_COMPLAINT." c 
      INNER JOIN " . TBL_COMP . " cc ON c.cat_comp_id = cc.cat_comp_id
      INNER JOIN ".TBL_DEPT." d ON c.dept_id = d.dept_id
      INNER JOIN ".TBL_USERS." u ON c.user_id = u.user_id WHERE c.status = '1' AND c.cat_comp_id BETWEEN '1' AND '2' " ;
      
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

  function getComplaintComplete(){
    global $database, $session;
    $q = "SELECT c.*, d.*, u.*, cc.* FROM ".TBL_COMPLAINT." c 
      INNER JOIN " . TBL_COMP . " cc ON c.cat_comp_id = cc.cat_comp_id
      INNER JOIN ".TBL_DEPT." d ON c.dept_id = d.dept_id
      INNER JOIN ".TBL_USERS." u ON c.user_id = u.user_id WHERE c.status = '1' AND c.cat_comp_id = '3' ";
      
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

  function getComplaintMonitored(){
		global $database, $session;
    $q = "SELECT c.*, d.*, u.*, ct.*, st.*, cc.* FROM ".TBL_COMPLAINT." c 
      INNER JOIN ".TBL_DEPT." d ON c.dept_id = d.dept_id
      INNER JOIN ".TBL_USERS." u ON c.user_id = u.user_id 
      INNER JOIN " . TBL_COMP . " ct ON c.cat_comp_id = ct.cat_comp_id
      INNER JOIN " . TBL_SPEC . " st ON c.cat_spec_id = st.cat_spec_id
      INNER JOIN " . TBL_CONC . " cc ON c.cat_con_id  = cc.cat_con_id
      WHERE c.status BETWEEN '2' AND '5' " ;
      
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

  function getUserAssistedComplaint()
  {
    global $database, $session;
    $q = "SELECT c.*, d.*, u.* FROM " . TBL_COMPLAINT . " c 
          INNER JOIN " . TBL_DEPT . " d ON c.dept_id = d.dept_id
          INNER JOIN " . TBL_USERS . " u ON c.user_id = u.user_id
          WHERE c.assisted = '$session->firstname $session->lastname' ";

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
  
  function getUsersComplaint()
  {
    global $database, $session;
    $q = "SELECT c.*, d.*, u.* FROM " . TBL_COMPLAINT . " c 
          INNER JOIN " . TBL_DEPT . " d ON c.dept_id = d.dept_id
          INNER JOIN " . TBL_USERS . " u ON c.user_id = u.user_id
          WHERE c.user_id = '$session->id'";

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


  function getAllComplaintBiomedical()
  {
    global $database, $session;
    $q = "SELECT c.*, cc.* FROM " . TBL_COMPLAINT . " c 
         INNER JOIN ".TBL_COMP." cc ON cc.cat_comp_id = c.cat_comp_id
         WHERE c.cat_comp_id = '1' ";

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

  function getAllComplaintIT()
  {
    global $database, $session;
    $q = "SELECT c.*, cc.* FROM " . TBL_COMPLAINT . " c 
         INNER JOIN ".TBL_COMP." cc ON cc.cat_comp_id = c.cat_comp_id
         WHERE c.cat_comp_id = '2' ";

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

  function getAllComplaintMC()
  {
    global $database, $session;
    $q = "SELECT c.*, cc.* FROM " . TBL_COMPLAINT . " c 
         INNER JOIN ".TBL_COMP." cc ON cc.cat_comp_id = c.cat_comp_id
         WHERE c.cat_comp_id = '3' ";

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

$complaints = new Complaints ();
?>
