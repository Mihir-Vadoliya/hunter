

<?php

include('config.php'); 
include('admin_validate_login.php'); 

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 

$sn=$_GET["sn"];
$id=$_GET["id"];
//echo $sn;
//echo $id;

$sql = "UPDATE details SET activated=0 WHERE  sn=$sn AND user_id='$id' ";

if ($con->query($sql) === TRUE) {
	//echo "deactive success";
   header('location:admin_id.php');
		exit;
} else {
    header('location:admin_id.php?');
		exit;
}

?>