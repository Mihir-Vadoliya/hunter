<?php 
include('config.php'); 

include('super_login_validate.php'); 
?>
<?php

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 

$sn=$_GET["sn"];
$id=$_GET["id"];

$sn =  $con->real_escape_string($sn);
$id =  $con->real_escape_string($id);
//$sql = "UPDATE userinfo SET status=1 WHERE  sn=$sn AND p_id='$id' ";
$sql = "UPDATE details SET activated=1 WHERE  sn=$sn AND user_id='$id' ";
if ($con->query($sql) === TRUE) {
    header('location:super_keys.php');
    ?><script>
          window.location = 'super_keys.php?id=';
          </script>
          <?php
		exit;
} else {

    header('location:super_id.php?');
     ?><script>
          window.location = 'super_keys.php?id=';
          </script>
          <?php 
		exit;
}

?>