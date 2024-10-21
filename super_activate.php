<?php 
include('config.php'); 
include('super_login_validate.php'); 
?>
<?php

include('config.php'); 

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 

$sn=$_GET["sn"];
$id=$_GET["id"];

$sn =  $con->real_escape_string($sn);
$id =  $con->real_escape_string($id);

$sql = "UPDATE userinfo SET status=0 WHERE  sn=$sn AND p_id='$id' ";

$sql3 = "UPDATE details SET activated=0 where agent_user='$id'";

//echo $sql;
//echo $sql2;
//echo $sql3;
//exit();

if (($con->query($sql) === TRUE)&& ($con->query($sql3) === TRUE)) {
    header('location:super_seller_list.php');
     ?><script>
          window.location = 'super_seller_list.php?id=';
          </script>
          <?php
		exit;
} else {
    header('location:login.php?');
     ?><script>
          window.location = 'super_home.php?id=';
          </script>
          <?php
		exit;
}

?>