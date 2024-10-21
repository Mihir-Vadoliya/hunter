<?php 
include('config.php'); 
include('mini_admin_head.php');

if(empty($_SESSION['miniadmin_id']))
{

  ?><script>

          window.location = 'index.php?err=Session has been expired';
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

$sql = "UPDATE sub_admin SET activated=0 WHERE  san=$sn AND sub_admin_id='$id' ";

if ($con->query($sql) === TRUE) {
	//echo "deactive success";
   header('location:mini_admin_subadmin_create.php');
		exit;
} else {
    header('location:mini_admin_subadmin_create.php');
		exit;
}

?>