<?php 
include('config.php'); 
include('admin_validate_login.php');

if(empty($_SESSION['info']['admin_id']))
{

  ?><script>

          window.location = 'login.php?err=Session has been expired';
          </script>
          <?php
    exit;
}
?>

<?php



if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 

$sn=$_GET["sn"];
$id=$_GET["id"];
//echo $sn;
//echo $id;
$sn =  $con->real_escape_string($sn);
$id =  $con->real_escape_string($id);

$sql = "UPDATE details SET activated=0 WHERE  sn=$sn AND user_id ='$id' ";

if ($con->query($sql) === TRUE) {
	//echo "deactive success";
   header('location:admin_id.php');
    $_SESSION['success'] = "ID Activated......";
		exit;
} else {
    header('location:admin_id.php?');
		exit;
}

?>