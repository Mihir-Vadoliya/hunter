
<?php 
include('config.php'); 
include('admin_login_validate.php'); 


//include('config.php'); 

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 


$id=$_GET["uidu"];
// echo "string";
// echo "$id";
// exit();
$id =  $con->real_escape_string($id);
$sql = "UPDATE soft_news SET news='$id' where nno=2";

if ($con->query($sql) === TRUE) {
    header('location:admin_home.php');
		exit;
} else {
    header('location:admin_login.php?');
		exit;
}

?>