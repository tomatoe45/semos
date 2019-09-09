<?php 

  include '../../include/session.php';

  if($_POST['comp_id']) {
    $start = $_POST['comp_id'];
    $tblContent = '';
    $stmt = $database->prepare("SELECT c.*, d.*, u.*, ct.*, st.*, cc.* FROM ".TBL_COMPLAINT." c 
                                                INNER JOIN " . TBL_DEPT ." d ON c.dept_id = d.dept_id
                                                INNER JOIN " . TBL_USERS." u ON c.user_id = u.user_id 
                                                INNER JOIN " . TBL_COMP . " ct ON c.cat_comp_id = ct.cat_comp_id
                                                INNER JOIN " . TBL_SPEC . " st ON c.cat_spec_id = st.cat_spec_id
                                                INNER JOIN " . TBL_CONC . " cc ON c.cat_con_id  = cc.cat_con_id WHERE ct.cat_complaint LIKE '%".$start."%'");
    $stmt->execute(array(':comp_id' => $start . '%'));
    ?>
      <option value="" selected="selected">ALL</option>
    <?php
    $l_comp = $stmt->fetchAll();
    foreach ($l_comp as $lc) {
      $tblContent = $tblContent . "<tr><td>".$lc['subject']."</td></tr>";
    }
  }

?>