<?php 
include '../../include/session.php';
if($_POST['id'])
{
  $id = $_POST['id'];

  $stmt = $database->prepare("SELECT * FROM ". TBL_SPEC ." WHERE cat_comp_id = :id ");
  $stmt->execute(array(':id' => $id));
  ?>
  <option value="" selected="selected" disabled="disabled">PLEASE SELECT SPECIFIC CATEGORY</option>
  <?php
  while($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
    ?>
    <option value="<?= $row['cat_spec_id']; ?>"><?= strtoupper($row['cat_specific']); ?></option>
    <?php
  }
}

?>