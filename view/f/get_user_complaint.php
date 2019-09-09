  <?php
  include '../../include/session.php';
  global $database, $session;
  $q = "SELECT co.*, c.*, s.*, cc.*, d.* FROM ". TBL_COMPLAINT ." co
  INNER JOIN ".TBL_COMP." c ON co.cat_comp_id = c.cat_comp_id
  INNER JOIN ".TBL_SPEC." s ON co.cat_spec_id = s.cat_spec_id
  INNER JOIN ".TBL_CONC." cc ON co.cat_con_id = cc.cat_con_id
  INNER JOIN ".TBL_DEPT." d ON co.dept_id = d.dept_id
  WHERE user_id = '" . $session->id . "' AND co.status BETWEEN '0' AND '2' ORDER BY co.comp_id DESC ";;
  $result = $database->prepare($q);
  $result->execute();

  $dbarray = $result->fetchAll(PDO::FETCH_ASSOC);

  $num_rows = $result->rowCount();

  if(!$result || ($num_rows < 0))
  {
    echo 'Error displaying info.';
    return;
  } 
  
  if($num_rows == 0) {
    echo 'No data available in table';
    return;
  }  

  ?>
  <table id="datatable5" class="table table-hover table-responsive">
    <thead>
      <tr>
        <th data-toggle="tooltip" data-placement="top"  title="Complaint ID">ID</th>
        <th data-toggle="tooltip" data-placement="top"  title="Subject of the Complaint">SUBJECT</th>
        <th data-toggle="tooltip" data-placement="top"  title="Description of the Complaint">COMPLAINT TYPE</th>
        <th data-toggle="tooltip" data-placement="top"  title="Assisted Complaint"><i class="fa fa-shield"></i> ASSISTED BY</th>
        <th data-toggle="tooltip" data-placement="top"  title="Status">STATUS</th>
      </tr>
    </thead>

    <tbody>
  <?php foreach($dbarray as $c) {  ?>
  <tr>
   <?php if($c['cat_comp_id'] == '3' ) { echo "<td class='main_comp c_id' width='50' align='center'>"; }
    else { echo "<td class='it_comp c_id'  width='50' align='center'>"; } ?>
        <span class='btn btn-rounded btn-danger btn-outline btn-sm'><strong><?= $c['comp_id']; ?></strong></span></td>
      <td>
        <a href="complaint_status.php?comp_id=<?= $c['comp_id'] ?>" class="btn btn-primary btn-rounded btn-outline btn-xs"> <i
          class="fa fa-plus" data-toggle="tooltip"
          data-placement="top" title="View Details"></i></a>
           <?= ucfirst($c['subject']); ?>
        </td>
      <td width="300" align="center"><?= strtoupper($c['cat_complaint']); ?></td>
      <td width="150"><?=$c ['assisted'] ?
              "<button type='button' class='btn btn-success btn-xs col-md-12 col-sm-12 col-xs-12'><i class='fa fa-shield'></i> " . ucwords ( $c ['assisted'] ) . "</button>" :
              "<a href='complaint_status.php?comp_id=".$c['comp_id']."' class='btn btn-success btn-xs col-md-12 col-sm-12 col-xs-12'><i class='fa fa-spinner fa-spin'></i> REQUESTING&hellip;</a>";?></td>
      <td width="90"><?=$c ['status'] == 0 ? "<a href='complaint_status.php?comp_id=".$c['comp_id']."' class='btn btn-default btn-xs col-md-12 col-sm-12 col-xs-12'>
          <i class='fa fa-spinner fa-spin'></i> PROCESSING&hellip;</a>" : ($c ['status'] == 1 ?
            "<a href='complaint_status.php?comp_id=".$c['comp_id']."' class='btn btn-info btn-xs col-md-12 col-sm-12 col-xs-12'><i class='fa fa-comments-o'></i> ASSISTED</button>" :
              ($c ['status'] == 2 ? 
                "<a href='complaint_status.php?comp_id=".$c['comp_id']."' class='btn btn-warning btn-xs col-md-12 col-sm-12 col-xs-12'><i class='fa fa-exclamation-triangle'></i> PENDING</a>" :
                ($c ['status'] == 5 ? "<a href='complaint_status.php?comp_id=".$c['comp_id']."' class='btn btn-success btn-xs col-md-12 col-sm-12 col-xs-12'><i class='fa fa-check-square-o'></i> RESOLVED</button>" :
                "")));?></td>
      </tr>
      <?php
        include '../modal/modal_c_toggle.php';
        include '../modal/modal_c_details.php';
        ?>
      <?php } ?>
    </tbody>
  </table>

