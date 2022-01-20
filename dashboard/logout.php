<?php 
session_start();

$_SESSION['u_name'] = "";
$_SESSION['u_id'] = "";
$_SESSION['is_active'] = "FALSE";

header("LOCATION:../sign_in.php");

session_destroy();
?>