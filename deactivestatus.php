<?php 
   session_start();
   include('config.php'); 
   include('admin_login_validate.php');
   $value = $_GET['status'];
   $paymentstm="UPDATE `demoswitch` SET `status`='Deactive'";
   $result=mysqli_query($con,$paymentstm);
   header("Location:admin_home.php");
?>
