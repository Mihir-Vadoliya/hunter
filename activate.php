<?php 
include('config.php'); 
include('seller_login_validate.php'); 
?>
<?php



if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 

$sn=$_GET["sn"];
$id=$_GET["id"];


$sn =  $con->real_escape_string($sn);
$id =  $con->real_escape_string($id);
$sql = "UPDATE details SET activated=0 WHERE  sn=$sn AND user_id='$id' ";

if ($con->query($sql) === TRUE) {
    header('location:keys.php?id=Id Activated');
		exit;
} else {
   header('location:home.php?');
		exit;
}

?>