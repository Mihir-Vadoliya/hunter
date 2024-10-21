
<?php 
include('config.php'); 
include('admin_validate_login.php'); 

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
    header('location:admin_id.php');
    $_SESSION['success'] = "MAC is Reset Successfully!";
		exit;
} else {
   header('location:admin_id.php?');
    $_SESSION['success'] = "MAC is not Reset Successfully!";
		exit;
}

?>