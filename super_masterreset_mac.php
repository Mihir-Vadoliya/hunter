<?php 
  include('config.php'); 
include('super_head.php');
date_default_timezone_set("Asia/Kolkata");

//include('config.php'); 

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 

$sn=$_GET["sn"];
$id=$_GET["id"];

$sn =  $con->real_escape_string($sn);
$id =  $con->real_escape_string($id);

$sql = "UPDATE details SET mac='not_registered' WHERE  sn=$sn AND user_id='$id' ";

if ($con->query($sql) === TRUE) {
    header('location:super_keys.php?id=SUCCESS');
		exit;
} else {
   header('location:super_keys.php?ERROR');
		exit;
}

?>