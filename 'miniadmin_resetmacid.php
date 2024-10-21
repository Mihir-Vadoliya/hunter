<?php 
include('config.php'); 
include('miniadmin_login_validate.php'); 

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
    header('location:allkeysinminiadmin.php?id=Success');
		exit;
} else {
   header('location:allkeysinminiadmin.php?id=Failed');
		exit;
}

?>