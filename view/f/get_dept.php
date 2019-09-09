<?php 
include '../../include/session.php';

global $database;
$q = "SELECT * FROM " . TBL_DEPT;
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

foreach ($dbarray as $dept) {
?>
<table id="datatable1" class="table table-hover">
  <thead>
    <tr>
      <th width="20">DEPARTMENT ID</th>
      <th>DEPARTMENT NAME</th>
      <th width="150">ACTION</th>
    </tr>
  </thead>
  <tbody>
   <tr>
      <td><?= $dept['dept_id']; ?></td>
      <td><?= strtoupper($dept['dept_name']); ?></td>
      <td><a href="#up_dept<?= $dept['dept_id']; ?>"
        data-toggle="modal" class="btn btn-success btn-xs"><i
          class="fa fa-edit"></i></a> <a
        href="f/remove_dept.php?dept_id=<?= $dept['dept_id']; ?>"
        class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
      </td>
    </tr>    
  </tbody>
</table>

<?php
}

?>
