<?php 
include('config.php'); 
include('miniadmin_login_validate.php'); 



if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 

$sn=$_GET["sn"];
$id=$_GET["id"];

echo "string";
//echo $sn;
//echo $id;

$sn =  $con->real_escape_string($sn);
$id =  $con->real_escape_string($id);

$sql =  "UPDATE details SET activated=1 WHERE  sn=$sn AND user_id ='$id' ";

if ($con->query($sql) === TRUE) {
	//echo " deactive success";
    header('location:allkeysinminiadmin.php?id=Success');
		exit;
} else {
    header('location:allkeysinminiadmin.php?id=Failed');
		exit;
}

?>