
<?php 
include('config.php'); 
include('admin_validate_login.php');
date_default_timezone_set("Asia/Calcutta");


if(empty($_SESSION['adminid']))
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
$reg_date=date('Y-m-d h:i:sa');
 
 $sql17 = "SELECT * FROM sub_admin where san='$sn' AND 	sub_admin_id='$panelid'";
 $result17= $con->query($sql17);
 while($row = $result17->fetch_assoc()) {
    $credit= $row["payment"];

 }
 $newcredit = ($credit-$num);
 
 
 $sql = "update sub_admin set payment = '$newcredit' where san='$sn' AND sub_admin_id='$panelid'";

 if(isset($_SESSION['adminid'])){
    $adminid = $_SESSION['adminid'];
    
    $sqladminame = "SELECT * FROM admin where an ='$adminid'";
   $resultadminaem= $con->query($sqladminame);
  while($rowadmin = $resultadminaem->fetch_assoc()) {
    $adminname= $rowadmin["admin_id"];

  } 
}
 
 $sql12 = "insert into credit_log (transaction_by, transaction_for, credit_amount, mode,admin_id) VALUES ('$adminname','$panelid','$num','DEDUCT','$adminid')";

if ($con->query($sql) === TRUE AND $con->query($sql12) === TRUE) {
  $_SESSION['success'] = 'Credit Deduct Successfully!';
  header('location:subadmin_create.php?id=success');
  exit;
} else {
 header('location:subadmin_create.php?id=error');
  exit;
}

?>
