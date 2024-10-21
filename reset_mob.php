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


$sql = "UPDATE details SET mob='not_registered' WHERE  sn=$sn AND user_id='$id' ";

if ($con->query($sql) === TRUE) {
    header('location:keys.php');
		exit;
} else {
   header('location:home.php?');
		exit;
}

?>