<?php 
include('config.php'); 
include('admin_login_validate.php'); 
?>
  
  <?php

include('config.php'); 

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 

$sn=$_GET["sn"];
$id=$_GET["id"];
$sn =  $con->real_escape_string($sn);
$id =  $con->real_escape_string($id);


$sql = "UPDATE userinfo SET status=1 WHERE  sn=$sn AND p_id='$id' ";

if ($con->query($sql) === TRUE) {
    header('location:admin_seller_list.php');
		exit;
} else {
    header('location:admin_seller_list.php?');
		exit;
}

?>