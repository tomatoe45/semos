<?php 

include '../session.php';

function getComplaintTotal()
{
  if($this->num_get_complaint < 0)
  {
    $q = "SELECT * FROM " . TBL_COMPLAINT;
    $result = $this->prepare($q);
    $result->execute();
    $this->num_get_complaint = $result->rowCount();
  }
  return $this->num_get_complaint;
}

?>