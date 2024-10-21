<?php 
include('config.php'); 
include('miniadmin_login_validate.php');

if(empty($_SESSION['miniadmin_id']))
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
$sn =  $con->real_escape_string($sn);
$id =  $con->real_escape_string($id);

$sql = "UPDATE super SET status=0 WHERE  sn=$sn AND s_id='$id' ";

if (($con->query($sql) === TRUE)) {

   header('location:miniadmin_superlist.php?id=SUPER ACTIVATED!');
		exit;
} else {
    header('location:miniadmin_superlist.php?id= FAILED!');
		exit;
}

?>