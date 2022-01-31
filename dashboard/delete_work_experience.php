<?php
session_start();
include('../includes/connect.php');
$id=$_GET['id'];
try{
    $sql="DELETE FROM user_experience WHERE id=$id";
    $con->exec($sql);
    $msg="deleted successfully";
}catch(PDOException $e){
    $msg="something went wrong";
}
header('location:work_experiance.php?msg='.$msg);
?>