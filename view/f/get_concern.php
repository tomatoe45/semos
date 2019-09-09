<?php 
include '../../include/session.php';
if($_POST['id'])
{
  $id = $_POST['id'];

  $stmt = $database->prepare("SELECT * FROM ". TBL_CONC ." WHERE cat_spec_id = :id ");
  $stmt->execute(array(':id' => $id));
  ?>
  <option value="" selected="selected" disabled="disabled">SELECT CONCERN CATEGORY</option>
  <?php
  while($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
    ?>
    <option value="<?= $row['cat_con_id']; ?>"><?= strtoupper($row['cat_concern']);; ?></option>
    <?php
  }
}

?>