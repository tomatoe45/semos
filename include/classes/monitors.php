<?php 

class Monitor {

function displayComplaintStillPending() {
  global $database;
  $q = "SELECT ". TBL_MONITOR .".*, " . TBL_USERS . ".* FROM " . TBL_MONITOR . " INNER JOIN " . TBL_USERS . " ON ". TBL_MONITOR .".user_id = " . TBL_USERS . ".user_id WHERE status = '0' ";
  $result = $database->prepare($q);
  $result->execute();
  $dbarray = $result->fetchAll(PDO::FETCH_ASSOC);
  /*Error occured, return given name by default*/
  $num_rows = $result->rowCount();
  if(!$result || ($num_rows < 0)) {
    echo 'Error displaying info.';
    return;
  }
  
  if($num_rows == 0) {
      echo "<div class='col-md-12 col-sm-12 col-xs-12'>";
      echo "<div class='x_panel'>";
      echo "<div class='x_content'>";
      echo 'No data available to be displayed';
      echo '</div>';
      echo '</div>';
      echo '</div>';
    return;
  } 

  return $dbarray;
}


function displayDoneComplaint() {
  global $database;
  $q = "SELECT * FROM " . TBL_MONITOR . " WHERE status = '1' ";
  $result = $database->prepare($q);
  $result->execute();
  $dbarray = $result->fetchAll(PDO::FETCH_ASSOC);
  /*Error occured, return given name by default*/
  $num_rows = $result->rowCount();
  if(!$result || ($num_rows < 0)) {
    echo 'Error displaying info.';
    return;
  }
  if($num_rows == 0) {
      echo "<div class='col-md-12 col-sm-12 col-xs-12'>";
      echo "<div class='x_panel'>";
      echo "<div class='x_content'>";
      echo 'No data available to be displayed';
      echo '</div>';
      echo '</div>';
      echo '</div>';
    return;
  } 
  return $dbarray;
}


/*Display Complaint Monitor History*/
function displayMonitoringComplaint() {
  global $database;
  $q = "SELECT ". TBL_MONITOR .".*, ". TBL_USERS .".* FROM " . TBL_MONITOR . " INNER JOIN " . TBL_USERS . " ON " . TBL_MONITOR . ".user_id = " . TBL_USERS . ".id";
  $result = $database->prepare($q);
  $result->execute();
  $dbarray = $result->fetchAll(PDO::FETCH_ASSOC);
  /*Error occured, return given name by default*/
  $num_rows = $result->rowCount();
  if(!$result || ($num_rows < 0)) {
    echo 'Error displaying info.';
    return;
  }
  if($num_rows == 0) {
      echo "<div class='col-md-12 col-sm-12 col-xs-12'>";
      echo "<div class='x_panel'>";
      echo "<div class='x_content'>";
      echo 'No data available to be displayed';
      echo '</div>';
      echo '</div>';
      echo '</div>';
    return;
  }
  return $dbarray;
  }
}
?>