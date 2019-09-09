<?php 

class Tasks extends MyPDO
{
  function getAllTask()
  {
    global $database;
    $q = "SELECT t.*, u.*, ct.*, st.*, cc.* FROM " . TBL_TASK . " t 
    INNER JOIN " . TBL_USERS . " u ON t.user_id = u.user_id
    INNER JOIN " . TBL_COMP . " ct ON t.cat_comp_id = ct.cat_comp_id
    INNER JOIN " . TBL_SPEC . " st ON t.cat_spec_id = st.cat_spec_id
    INNER JOIN " . TBL_CONC . " cc ON t.cat_con_id  = cc.cat_con_id";
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

  function getUserTask()
  {
    global $database, $session;
    $q = "SELECT t.*, u.* FROM " . TBL_TASK . " t 
          INNER JOIN " . TBL_USERS . " u ON t.user_id = u.user_id 
          WHERE u.user_id = '$session->id'";
    $result = $database->prepare($q);
    $result->execute();

    $dbarray = $result->fetchAll(PDO::FETCH_ASSOC);
    $num_rows = $result->rowCount();

    if(!$result || ($num_rows < 0 ))
    {
      echo 'Error displaying info.';
      return;
    }
    return $dbarray;
  }

}

$tasks = new Tasks();
