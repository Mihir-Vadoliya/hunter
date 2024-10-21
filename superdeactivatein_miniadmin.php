<?php 
include('config.php'); 
include('miniadmin_login_validate.php'); 



if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 

$sn=$_GET["sn"];
$id=$_GET["id"];

$sn =  $con->real_escape_string($sn);
$id =  $con->real_escape_string($id);

$sql =  "UPDATE super SET status=1 WHERE  sn=$sn AND s_id='$id' ";

if (($con->query($sql) === TRUE)) {
    header('location:miniadmin_superlist.php?id=SUPER DEACTIVATE!');
		exit;
} else {
    header('location:login.php?');
		exit;
}

?>