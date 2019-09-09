<?php 
include '../../../include/session.php';
if($_POST['id'])
{
  $id = $_POST['id'];
  $str = $_POST['cons_name'];
  $stmt = $database->prepare("SELECT * FROM ". TBL_CONC ." WHERE cat_spec_id = :id ");
  $stmt->execute(array(':id' => $id));
  ?>
  <option value="" disabled="disabled" selected="selected">SELECT CONCERN CATEGORY</option>
  <?php
  while($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
    ?>
    <option value="<?= $row['cat_con_id']; ?>"<?php $id = $row['cat_con_id']; if($str == $id) {echo 'selected';} ?>><?= strtoupper($row['cat_concern']);; ?></option>
    <?php
  }
}

?>