<?php 
include '../../include/session.php';

global $database;
$q = "SELECT c.*, d.*, u.*, ct.*, st.*, cc.*  FROM ".TBL_COMPLAINT." c 
      INNER JOIN " . TBL_DEPT . " d ON c.dept_id      = d.dept_id
      INNER JOIN " . TBL_USERS. " u ON c.user_id      = u.user_id
      INNER JOIN " . TBL_COMP . " ct ON c.cat_comp_id = ct.cat_comp_id
      INNER JOIN " . TBL_SPEC . " st ON c.cat_spec_id = st.cat_spec_id
      INNER JOIN " . TBL_CONC . " cc ON c.cat_con_id  = cc.cat_con_id
      WHERE c.status = '0' ORDER BY c.comp_id DESC " ;
$result = $database->prepare($q);
$result->execute();

$dbarray = $result->fetchAll(PDO::FETCH_ASSOC);
$num_rows = $result->rowCount();

if(!$result || ($num_rows < 0)) {
  echo 'Error displaying info.';
  return;
}

if($num_rows == 0) {
  echo "No data available in table";
  return;
}


foreach ($dbarray as $uc) {
?>

<style type="text/css" media="screen">
.content_details {
  font-style: italic;
  font-family: Lucida Sans;
  font-size: 1.3em;
}
.content_desc {
  font-style: italic;
  font-family: Lucida Sans;
  font-size: .8em;
}

.cc_id {
  padding-top: .8em;
}
#cc_id_p {
  padding-top: 5em;
}

</style>
<link rel="stylesheet" href="../../build/css/alt_complaint.css">
    <table id="datatable6" class="table complaint_table">
  <thead>
    <tr>
      <th>ID</th>
      <th>COMPLAINT DESCRIPTION</th>
      <th width="250px">ACTIONS</th>
    </tr>
  </thead>
  <tbody>
    <tr>
  <?php   if($uc['cat_comp_id'] == '3' ) { 
            echo "<td class='main_comp'width='150' align='center'>"; 
          } else { 
            echo "<td class='it_comp'width='150' align='center'>";
          } ?>
      <p id='cc_id_p'><span class='btn btn-rounded btn-danger btn-outline btn-sm cc_id'><strong><?= $uc['comp_id']; ?></strong></span></p></td>
      <td>
        <div class="messages">
          <div class="message_wrapper">
            <h5 class="heading title_head"><strong>SUBJECT</strong></h5>
            <p class="content_details"><?= ucfirst($uc['subject']); ?></p>
            <h5 class="heading title_head"><strong>DESCRIPTION</strong></h5>
            <p class="content_details"><?= ucfirst($uc['description']); ?></p>
            <br>
            <p class="url">
              <span class="fs1 text-info" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;
              <a href="#" class="content_desc" data-toggle="tooltip" data-placement="top" title="Complainant Name"><i class="fa fa-user"></i> <?= strtoupper($uc['firstname'] . ' ' . $uc['lastname']); ?> </a>

              <span class="fs1 text-info" aria-hidden="true"></span> &nbsp;&nbsp;&nbsp;&nbsp;
              <a href="#" class="content_desc" data-toggle="tooltip" data-placement="top" title="Complainant Department"><i class="fa fa-hospital-o"></i> <?= strtoupper($uc['dept_name']); ?> </a> 

              <span class="fs1 text-info" aria-hidden="true"></span> &nbsp;&nbsp;&nbsp;&nbsp;
              <a href="#" class="content_desc" data-toggle="tooltip" data-placement="top" title="Requested Date"><i class="fa fa-clock-o"></i> <?= strtoupper(date('M. d Y', strtotime($uc['req_date']))); ?> </a>

              <span class="fs1 text-info" aria-hidden="true"></span> &nbsp;&nbsp;&nbsp;&nbsp;
               <a href="#" class="content_desc"><i class="fa fa-paperclip"></i> ATTACHMENT : <?=  $uc['file'] ? 
               "<a href='download.php?file=". $uc['file'] ."' data-toggle='tooltip' data-placement='top' title='Download Attachment File'><i class='fa fa-download'></i></a>" : 
               "<i class='fa fa-unlink' data-toggle='tooltip' data-placement='top' title='No File Attach'></i>"; ?></a>
            </p>
          </div>
        </div>
      </td>
      <td align="center">
      <?php if(($uc['cat_comp_id'] == '3') && ($session->dept == 'maintenance department'))  {  ?>
          <a href="complaint_r.php?comp_id=<?= $uc['comp_id'] ?>" data-toggle="tooltip" data-placement="top" title="REVIEW COMPLAINT" class="btn btn-app"> 
          <i class="fa fa-hand-o-up"></i> REVIEW</a>
       <?php } else if($session->dept != 'maintenance department'){ ?>
          <a href="complaint_r.php?comp_id=<?= $uc['comp_id'] ?>" data-toggle="tooltip" data-placement="top" title="REVIEW COMPLAINT" class="btn btn-app"> 
          <i class="fa fa-hand-o-up"></i> REVIEW</a>
       <?php } ?>
      <br>
           <small><?= strtoupper($uc['cat_complaint']); ?></small>
      </td>
    </tr>      
  </tbody>
</table>
<?php
}
?>

