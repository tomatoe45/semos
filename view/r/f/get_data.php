<?php 
include '../../../include/session.php';
if($_POST['id'])
{
  $id = $_POST['id'];

  $stmt = $database->prepare("SELECT c.*, d.* FROM ".TBL_COMPLAINT." c
    INNER JOIN ".TBL_DEPT." d ON c.dept_id = d.dept_id
    WHERE dept_name = '%ADMIN DEPARTMENT%' ");
  $stmt->execute(array(':id' => $id));
?>
<tr>
    <td>1</td>
    <td>2</td>
    <td>3</td>
    <td>4</td>
    <td>5</td>
    <td>6</td>
    <td>7</td>
  </tr>
<?php
while($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
  ?>
  <tr>
    <td><?= $row['ticket']; ?></td>
    <td><?= $row['subject']; ?></td>
    <td><?= date('M. d Y h:i A', strtotime($row['req_date'])); ?></td>
    <td><?= date('M. d Y h:i A', strtotime($row['res_date'])); ?></td>
    <td>data</td>
    <td><?= $row['assisted']; ?></td>
    <td><?= $row['status'] == 5 ? 
            "<span class='btn btn-success btn-xs col-md-12 col-sm-12 col-xs-12'><i class='fa fa-check-square-o'></i> RESOLVED</span>"
          : ($row['status'] == 2 ? "<span class='btn btn-success btn-xs col-md-12 col-sm-12 col-xs-12'><i class='fa fa-exclamation-triangle'></i> PENDING</span>"
          : ($row['status'] == 1 ? "<span class='btn btn-success btn-xs col-md-12 col-sm-12 col-xs-12'><i class='fa fa-shield'></i> ASSISTED</span>"
          : "<span class='btn btn-info btn-xs col-md-12 col-sm-12 col-xs-12'><i class='fa fa-spinner fa-spin'></i> PROCESSING</span>")); ?></td>
  </tr>
  <?php
}
}
?>