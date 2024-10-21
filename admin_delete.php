<?php 
include('config.php'); 
include('admin_validate_login.php'); 


//include('config1.php'); 

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 



date_default_timezone_set("Asia/Kolkata");
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


$sql = "DELETE FROM details WHERE  sn=$sn AND user_id='$id' ";

if ($con->query($sql) === TRUE) {
    header('location:admin_id.php?id=success');
		exit;
} else {
  header('location:admin_id.php?id=fail');
		exit;
}

?>

