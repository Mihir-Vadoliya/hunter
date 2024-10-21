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


$sql = "UPDATE details SET mac='not_registered' WHERE  sn=$sn AND user_id='$id' ";

if ($con->query($sql) === TRUE) {
    header('location:keys.php');
    $_SESSION['creditempty'] = "<h4 style='color:green';>MAC Reset Successfully...........!</h4>";
		exit;
} else {
   header('location:home.php?');
		exit;
}

?>