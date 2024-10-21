<?php 
include('config.php'); 
include('super_login_validate.php'); 
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



$sql3 = "UPDATE details SET activated=1 where agent_user='$id'";

//echo $sql;
//echo $sql2;
//echo $sql3;
//exit();

if (($con->query($sql) === TRUE)&& ($con->query($sql3) === TRUE)) {
    header('location:super_seller_list.php');
		exit;
} else {
    header('location:login.php?');
		exit;
}

?>