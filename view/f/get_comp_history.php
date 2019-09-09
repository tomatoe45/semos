<?php

include '../include/session.php';

$tableContent = '';
$start = '';
$selectStmt = $database->prepare('SELECT * FROM' . TBL_COMPLAINT);
$selectStmt->execute();
$users = $selectStmt->fetchAll();

foreach ($users as $user)
{
    $tableContent = $tableContent.'<tr>'.
            '<td>'.$user['comp_id'].'</td>'
            .'<td>'.$user['ticket'].'</td>'
            .'<td>'.$user['status'].'</td>'
            .'<td>'. $user['req_date'].'</td>';
}

if(isset($_POST['search']))
{
$start = $_POST['starts'];
$tableContent = '';
$selectStmt = $database->prepare("SELECT * FROM ". TBL_COMPLAINT ." WHERE status like '%".$start."%' ");
$selectStmt->execute(array(':start'=>$start.'%'));

$users = $selectStmt->fetchAll();

foreach ($users as $user)  {
        $tableContent = $tableContent.'<tr>'
                    .'<td>'.$user['comp_id'].'</td>'
                    .'<td>'.$user['ticket'].'</td>'
                    .'<td>'.$user['status'].'</td>'
                    .'<td>'.$user['req_date'].'</td>'
                    .'</tr>';
    }
}
?>