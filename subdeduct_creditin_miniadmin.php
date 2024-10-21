
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
$reg_date=date('Y-m-d h:i:sa');
 
 $sql17 = "SELECT * FROM sub_admin where san='$sn' AND 	sub_admin_id='$panelid'";
 $result17= $con->query($sql17);
 while($row = $result17->fetch_assoc()) {
    $credit= $row["payment"];

 }
 if($credit >= $num && $num > 0){
   $newcredit = ($credit-$num);
 
 
 $sql = "update sub_admin set payment = '$newcredit' where san='$sn' AND sub_admin_id='$panelid'";

 if(isset($_SESSION['miniadmin_id'])){
    $adminid = $_SESSION['miniadmin_id'];
    
    $sqladminame = "SELECT * FROM mini_admin where 	mini_id ='$adminid'";
   $resultadminaem= $con->query($sqladminame);
  while($rowadmin = $resultadminaem->fetch_assoc()) {
    $adminname= $rowadmin["mini_admin_id"];
    $miniadmincredit = $rowadmin['payment'];

  } 
}

$newminicredit = $miniadmincredit + $num;
$minicreditupdate = "update mini_admin set payment = '$newminicredit' where mini_id ='$adminid'";
 
$sql12 = "insert into credit_log (transaction_by, transaction_for, credit_amount, mode,miniadmin_id) VALUES ('$adminname','$panelid','$num','DEDUCT','$adminid')";  
 }else{
      $_SESSION['success'] = '<p class="text-danger">Please Input Credit Carefully!</p>';
      header('location:mini_admin_subadmin_create.php?id=success');
      exit;
 }
 

if ($con->query($sql) === TRUE AND $con->query($sql12) === TRUE AND $con->query($minicreditupdate) === TRUE) {
  $_SESSION['success'] = 'Credit Deduct Successfully!';
  header('location:mini_admin_subadmin_create.php?id=success');
  exit;
} else {
 header('location:mini_admin_subadmin_create.php?id=error');
  exit;
}

?>
