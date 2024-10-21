<?php 
include'config.php'; 
include'miniadmin_login_validate.php'; 
date_default_timezone_set("Asia/Kolkata");


//include('config1.php'); 

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 




$reg_date=time();
$sn=$_GET["sn"];
$id=$_GET["id"];

    $status=0;
	$reg_date=time();
	$payment=0;
	$expiry_date=strtotime('+30 day', $reg_date);
	$payment=0;
	$admin_pay=0;
	$super_pay=0;

  $sn =  $con->real_escape_string($sn);
  $id =  $con->real_escape_string($id);


$sql = "DELETE FROM userinfo  WHERE  sn='$sn' AND p_id ='$id' ";

if ($con->query($sql) === TRUE) {
    header('location:miniadmin_sellerlist.php?id=success');
		exit;
} else {
  header('location:miniadmin_sellerlist.php?id=fail');
		exit;
}






?>
