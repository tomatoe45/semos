<?php 
include '../../../include/session.php';

if($_POST['id'])
{
  $id = $_POST['id'];
  $strt = $_POST['spec_name'];
  $stmt = $database->prepare("SELECT * FROM ". TBL_SPEC ." WHERE cat_comp_id = :id ");
  $stmt->execute(array(':id' => $id));
  ?>
  <option value="" disabled="disabled" selected="selected">SELECT SPECIFIC CATEGORY</option>
  <?php
  while($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
    ?>
    <option value="<?= $row['cat_spec_id']; ?>"<?php $id = $row['cat_spec_id']; if($strt == $id) {echo 'selected';} ?>><?= strtoupper($row['cat_specific']); ?></option>
    <?php
  }
}

?>