
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
	$reg_date= date("Y-m-d H:i:s",time());
	$payment=0;
	$expiry_date=date("Y-m-d H:i:s",(strtotime('+30 day', time())));
	$payment=0;
	$admin_pay=0;
	$super_pay=0;

  $sn =  $con->real_escape_string($sn);
  $id =  $con->real_escape_string($id);

$sql = "UPDATE details SET payment=0,registration='$reg_date',expiry_date='$expiry_date',admin_pay=0, super_pay=0 WHERE  sn=$sn AND user_id='$id' ";

if ($con->query($sql) === TRUE) {
    header('location:admin_id.php?id=success');
		exit;
} else {
  header('location:admin_id.php?id=fail');
		exit;
}






?>

