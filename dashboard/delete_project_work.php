<?php
session_start();
include('../includes/connect.php');
$id = $_GET['id'];
try{
    $sql="DELETE FROM user_project_works WHERE id=$id";
    $con->exec($sql);
    $msg="Deleted successfully";
}catch(PDOException $e){
 $msg="Something went wrong";
}

header('LOCATION:project_work.php?msg='.$msg);

?>
