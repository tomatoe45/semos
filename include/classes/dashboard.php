<?php
class Dashboard extends MyPDO
{

  function getUserComplaint()
  {
    global $database, $session;
    $q = "SELECT co.*, c.*, s.*, cc.*, d.* FROM ". TBL_COMPLAINT ." co
    INNER JOIN ".TBL_COMP." c ON co.cat_comp_id = c.cat_comp_id
    INNER JOIN ".TBL_SPEC." s ON co.cat_spec_id = s.cat_spec_id
    INNER JOIN ".TBL_CONC." cc ON co.cat_con_id = cc.cat_con_id
    INNER JOIN ".TBL_DEPT." d ON co.dept_id = d.dept_id
    WHERE user_id = '" . $session->id . "' ";;
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

?>