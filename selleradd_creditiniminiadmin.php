<?php 
include('config.php'); 
include('miniadmin_login_validate.php');
date_default_timezone_set("Asia/Calcutta");


if(empty($_SESSION['miniadmin_id']))
{
  ?>
  <script>

          window.location = 'counterlogin.php?err=Session has been expired';
          </script>
          <?php
    exit;
}
?>
<?php

include('config.php'); 

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 


$sn=$_GET["sn"];
$panelid=$_GET["uid"];
$num=$_GET["num"];
$credit=0;
 $reg_date=time();
 
 $sql17 = "SELECT * FROM userinfo where sn='$sn' AND p_id ='$panelid'";
 $result17= $con->query($sql17);
 while($row = $result17->fetch_assoc()) {
    $credit= $row["user_credit"];

 }
 $newcredit = $credit+$num;
 
 $sql = "update userinfo set user_credit = '$newcredit' where sn='$sn' AND p_id='$panelid'";
 
if(isset($_SESSION['miniadmin_id'])){
    $adminid = $_SESSION['miniadmin_id'];
    
    $sqladminame = "SELECT * FROM mini_admin where mini_id ='$adminid'";
   $resultadminaem= $con->query($sqladminame);
  while($rowadmin = $resultadminaem->fetch_assoc()) {
    $adminname= $rowadmin["mini_admin_id"];

  } 
}
 
 $sql12 = "insert into credit_log (transaction_by, transaction_for, credit_amount, mode,miniadmin_id) VALUES ('$adminname','$panelid','$num','ADD','$adminid')";
if ($con->query($sql) === TRUE AND $con->query($sql12) === TRUE) {
  $_SESSION['success'] = 'Credit Added Successfully';
  header('location:miniadmin_sellerlist.php?id=success');
  exit;
} else {
 header('location:miniadmin_sellerlist.php?id=error');
  exit;
}

?>