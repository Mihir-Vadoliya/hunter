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

$sql = "UPDATE super SET status=0 WHERE  sn=$sn AND s_id='$id' ";

$sql2 = "UPDATE userinfo SET status=0 WHERE super_name='$id'";

$sql3 = "UPDATE details SET activated=0 where agent_user in (select p_id from userinfo where super_name='$id')";

//echo $sql;
//echo $sql2;
//echo $sql3;
//exit();

if (($con->query($sql) === TRUE) && ($con->query($sql2) === TRUE) && ($con->query($sql3) === TRUE)) {
	//echo "deactive success";
   header('location:admin_super_list.php');
		exit;
} else {
    header('location:admin_super_list.php?');
		exit;
}

?>