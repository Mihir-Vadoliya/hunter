<?php 
include('config.php'); 

include('seller_login_validate.php'); 
?>
<?php



if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 

$name=$_SESSION['info']['p_id'];
//$me=$_SESSION['info']['s_id'];
      
//$sql = "SELECT * FROM details where agent_user in (select p_id from userinfo where super_name='$name')";

$sql = "UPDATE details SET mac='not_registered',mob='not_registered' WHERE  agent_user ='$name'";

if ($con->query($sql) === TRUE) {
    header('location:home.php');
		exit;
} else {
   header('location:home.php?');
		exit;
}

?>